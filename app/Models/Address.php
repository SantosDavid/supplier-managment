<?php

namespace App\Models;

class Address extends BaseModel
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
