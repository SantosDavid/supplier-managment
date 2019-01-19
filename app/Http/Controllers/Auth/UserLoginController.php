<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class UserLoginController extends Controller
{
    protected $guard = 'users';

    public function login(LoginRequest $request, $company)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard($this->guard)->attempt($credentials)) {
            return responseError(['Não autorizado'], 401);
        }

        if (!Auth()->guard($this->guard)->user()->belongsToCompany($company)) {
            return responseError(['Não autorizado'], 403);
        }

        return responseSuccess(
            [
                'token' => $token,
                'expires' => auth()->guard($this->guard)->factory()->getTTL() * 60,
            ]
        );
    }
}
