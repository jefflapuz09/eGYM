<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';

    protected $fillable = [
        'id',
        'supplierId',
        'dateMake',
        'isActive',
        'isFinalize',
        'isDelivered'
    ];
}
