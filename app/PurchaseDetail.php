<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';

    protected $fillable = [
        'id',
        'purchaseId',
        'productId',
        'quantity',
        'delivered',
        'price'
    ];
}
