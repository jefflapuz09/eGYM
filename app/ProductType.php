<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'product_types';

    protected $fillable = [
        'name',
        'description',
        'isActive'
    ];

    public function typeBrand()
    {
        return $this->hasMany('App\TypeBrand','typeId');
    }
}
