<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVariant extends Model
{
    protected $table = 'type_variants';

    protected $fillable = [
        'typeId',
        'variantId'
    ];

    public function Type(){
        return $this->belongsTo('App\ProductType','typeId');
    }
}
