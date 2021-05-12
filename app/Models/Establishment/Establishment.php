<?php

namespace App\Models\Establishment;

use App\Models\User\User;
use App\Models\Establishment\Theme;
use App\Models\Establishment\Address;
use Illuminate\Database\Eloquent\Model;
use App\Models\Establishment\OpeningHour;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Establishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_link_name', 'name', 'description', 'phone', 'picture',
        'background_picture', 'delivery_time', 'min_value', 'need_confirm_order',
        'address_id', 'user_id'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function openingHours()
    {
        return $this->hasMany(OpeningHour::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}