<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'brand_id', 'slug', 'price', 'special_price', 'special_price_type',
        'special_price_start', 'special_price_end', 'selling_price', 'sku',
        'manage_stock', 'qty', 'in_stock', 'viewed', 'is_active'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function variations()
    {
        return $this->belongsToMany(Variation::class, 'product_variations');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->sku = strtoupper(Str::random(6)); // SKU gồm 6 ký tự ngẫu nhiên
        });
    }
}
