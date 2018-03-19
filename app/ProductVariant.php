<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';

    protected $fillable = [
        'size',
        'unit',
        'category',
        'isActive'
    ];
    
    public function Type()
    {
        return $this->hasMany('App\TypeVariant','variantId');
    }
}
