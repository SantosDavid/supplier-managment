<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class AdministratorController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('admins')->attempt($credentials)) {
            return $this->responseError(['Não autorizado'], 401);
        }

        return $this->responseSuccess([
            'token' => $token,
            'expires' => auth()->guard('admins')->factory()->getTTL() * 60,
        ]);
    }
}
