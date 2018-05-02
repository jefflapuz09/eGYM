<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDelivery extends Model
{
    protected $table = 'stock_deliveries';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'supplierId',
        'dateMake',
        'isActive'
    ];
}
