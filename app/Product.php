<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'price',
        'typeId',
        'variantId',
        'brandId',
        'reorder',
        'description',
        'isActive'
    ];
    
    public function Type()
    {
        return $this->belongsTo('App\ProductType','typeId');
    }
    
    public function Brand()
    {
        return $this->belongsTo('App\ProductBrand','brandId');
    }
    
    public function Variant()
    {
        return $this->belongsTo('App\ProductVariant','variantId');
    }
}
