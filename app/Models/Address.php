<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street',
        'number',
        'neighborhood',
        'city',
        'zipcode',
        'type',
    ];

    public function addresstable()
    {
        return $this->morphTo();
    }
}
