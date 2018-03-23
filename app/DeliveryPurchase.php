<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryPurchase extends Model
{
    protected $table = 'delivery_purchases';

    protected $fillable = [
        'deliveryId',
        'purchaseId'
    ];
}
