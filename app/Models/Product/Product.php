<?php

namespace App\Models\Product;

use App\Models\Product\Category;
use App\Models\Product\Additional;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'picture', 'priority', 'enable', 'user_id', 'description', 'price', 'user_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function additionals()
    {
        return $this->belongsToMany(Additional::class, 'product_additionals');
    }
}
