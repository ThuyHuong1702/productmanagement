<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    protected $fillable = ['slug', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
