<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'street',
        'brgy',
        'city',
        'contactNumber',
        'isActive'
    ];

    public function Purchase()
    {
        return $this->hasMany('App\Purchase','supplierId');
    }
}
