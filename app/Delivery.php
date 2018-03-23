<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public $incrementing = false;

    protected $table = 'deliveries';

    protected $fillable = [
        'supplierId',
        'dateMake',
        'isActive',
        'isReceived'
    ];
}
