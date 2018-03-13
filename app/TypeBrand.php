<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeBrand extends Model
{
    protected $table = 'type_brands';

    protected $fillable = [
        'typeId',
        'brandId'
    ];

    public function Type()
    {
        return $this->belongsTo('App\ProductType','typeId');
    }

    public function Brand()
    {
        return $this->belongsTo('App\ProductBrand','brandId');
    }
}
