<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class AdminLoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('admins')->attempt($credentials)) {
            return responseError(['Não autorizado'], 401);
        }

        return responseSuccess([
            'token' => $token,
            'expires' => auth()->guard('admins')->factory()->getTTL() * 60,
        ]);
    }
}
