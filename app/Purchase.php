<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchases';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'supplierId',
        'dateMake',
        'isActive',
        'isFinalize',
        'isDelivered'
    ];

    public function Supplier()
    {
        return $this->belongsTo('App\Supplier','supplierId');
    }

    public function Detail()
    {
        return $this->hasMany('App\PurchaseDetail','purchaseId');
    }
}
