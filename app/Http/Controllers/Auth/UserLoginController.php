<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class UserLoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('users')->attempt($credentials)) {
            return responseError(['Não autorizado'], 401);
        }

        return responseSuccess([
            'token' => $token,
            'expires' => auth()->guard('users')->factory()->getTTL() * 60,
        ]);
    }
}
