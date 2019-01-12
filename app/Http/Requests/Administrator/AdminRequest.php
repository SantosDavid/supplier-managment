<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'email' => 'required|email|unique:admins,email',

            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
