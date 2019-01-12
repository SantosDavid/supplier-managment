<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;
use App\Models\Address;

class Company extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'cnpj',
        'prefix',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addresstable');
    }
}
