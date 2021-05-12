<?php

namespace App\Http\Controllers\Establishment;

use Inertia\Inertia;
use App\Enums\DaysOfWeek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Establishment\Establishment;
use App\Http\Resources\Establishment\AddressResource;
use App\Http\Resources\Establishment\OpeningHoursResource;
use App\Http\Resources\Establishment\EstablishmentResource;
use App\Http\Requests\Establishment\EstablishmentStoreRequest;

class EstablishmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $establishments = $request->user()->establishments();

        return Inertia::render('Establishment/Index', [
            'establishments' => EstablishmentResource::collection($establishments->paginate(5))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Establishment/Form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\EstablishmentStoreRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(EstablishmentStoreRequest $request)
    {
        $input = $request->validated();

        $input['picture'] = Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/establishmentPicture', $request->file('picture'));
        $input['background_picture'] = Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/establishmentPicture', $request->file('background_picture'));
        $input['public_link_name'] = strtolower(str_replace(' ', '_', $input['name']));

        $request->user()->establishments()->create($input);

        return Redirect::route('establishmentIndex')->with('success', 'Estabelecimento criado com sucesso!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Establishment $establishment)
    {
        $establishment =  $request->user()->establishments()->findOrFail($establishment->id);

        return Inertia::render('Establishment/Form', ['establishment' => new EstablishmentResource($establishment)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {

        $establishment =  $request->user()->establishments()->findOrFail($establishment->id);

        if ($request->picture) {
            $establishment->picture =  Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/establishmentPicture', $request->file('picture'));
        }
        if ($request->background_picture) {
            $establishment->background_picture =  Storage::disk(env('FILESYSTEM_DRIVER'))->put('images/establishmentPicture', $request->file('background_picture'));
        }

        $establishment->name = $request->name;
        $establishment->description = $request->description;
        $establishment->phone = $request->phone;
        $establishment->delivery_time = $request->delivery_time;
        $establishment->min_value = $request->min_value;
        $establishment->need_confirm_order = $request->need_confirm_order;

        $establishment->public_link_name = strtolower(str_replace(' ', '_', $request->name));

        $establishment->save();

        return Redirect::route('establishmentIndex')->with('success', 'Estabelecimento atualizado com sucesso!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Establishment $establishment)
    {
        $request->user()->establishments()->findOrFail($establishment->id)->delete();

        return Redirect::back()->with('success', 'Estabelecimento Removido.');
    }

    public function customize(Request $request, Establishment $establishment)
    {
        $establishment =  $request->user()->establishments()->findOrFail($establishment->id);

        // $establishmentOpeningHours =  OpeningHoursResource::collection($establishment->openingHours);
        // if($establishment->openingHours()->count() !== 7) $establishmentOpeningHours = DaysOfWeek::List;

        $daysOfWeek = DaysOfWeek::List;

        return Inertia::render('Establishment/Customize', [
            'establishment' => new EstablishmentResource($establishment),
            'daysOfWeek' => $daysOfWeek
        ]);
    }
}