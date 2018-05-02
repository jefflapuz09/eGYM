<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDeliveryDetail extends Model
{
    protected $table = 'stock_delivery_details';
    
        protected $fillable = [
            'deliveryId',
            'productId',
            'quantity'
        ];
}
