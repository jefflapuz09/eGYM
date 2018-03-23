<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    protected $table = 'delivery_details';

    protected $fillable = [
        'deliveryId',
        'productId',
        'quantity',
        'returned'
    ];
}
