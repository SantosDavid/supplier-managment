<?php

namespace App\Models\Company;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Models\Company\Company;

class User  extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
