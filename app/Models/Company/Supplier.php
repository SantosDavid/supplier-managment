<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'monthly_payment',
    ];
}
