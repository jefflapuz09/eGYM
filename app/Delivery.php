<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $table = 'deliveries';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'supplierId',
        'dateMake',
        'isActive',
        'isReceived'
    ];
}
