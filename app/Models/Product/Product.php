<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'picture', 'priority', 'enable', 'user_id', 'description', 'price', 'user_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function additionals()
    {
        return $this->belongsToMany(Additional::class, 'product_additionals');
    }

    public function order_additionals()
    {
        return $this->belongsToMany(Additional::class, 'order_product_additionals')
            ->withPivot('quantity', 'order_id')
            ->join('orders', 'orders.id', '=', 'order_product_additionals.order_id');
    }
}
