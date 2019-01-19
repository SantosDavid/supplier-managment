<?php

namespace App\Models\Admin;

use App\Models\Address;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Tenant\User;

class Company extends BaseModel
{
    protected $fillable = [
        'name',
        'phone',
        'cnpj',
    ];

    public function addresses()
    {
        return $this->morphMany(Address::class, 'addresstable');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
