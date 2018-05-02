<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [
        'productId',
        'stock'
    ];

    public function Product()
    {
        return $this->belongsTo('App\Product','productId');
    }
}
