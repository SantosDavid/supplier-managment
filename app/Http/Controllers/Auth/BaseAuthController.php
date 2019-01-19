<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

abstract class BaseAuthController extends Controller
{
    protected $guard = null;

    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard($this->guard)->attempt($credentials)) {
            return responseError(['Não autorizado'], 401);
        }

        return responseSuccess([
            'token' => $token,
            'expires' => auth()->guard($this->guard)->factory()->getTTL() * 60,
        ]);
    }
}
