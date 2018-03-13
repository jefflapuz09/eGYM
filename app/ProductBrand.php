<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'product_brands';

    protected $fillable = [
        'name',
        'description',
        'isActive'
    ];
}
