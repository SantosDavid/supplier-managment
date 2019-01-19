<?php

namespace App\Http\Controllers\Auth;

class AdminLoginController extends BaseAuthController
{
    protected $guard = 'admins';
}
