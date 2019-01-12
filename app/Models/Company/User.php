<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'email',
        'password',
    ];
}
