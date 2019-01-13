<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'name' => 'required|string|min:6|max:255',

            'phone' => 'required|string|telefone_com_ddd',

            'cnpj' => 'required|string|cnpj|unique:companies,cnpj',
            

            'addresses' => 'required|array',

            'addresses.*.street' => 'required|string|min:3|max:255',

            'addresses.*.number' => 'nullable|integer|min:1|max:999999',

            'addresses.*.neighborhood' => 'required|string|min:3|max:255',

            'addresses.*.city' => 'required|string|min:3|max:255',

            'addresses.*.zipcode' => 'required|string|formato_cep',
            
            'addresses.*.type' => [
                
                'required', 
                
                'string', 
                
                Rule::in(['thirst', 'subsidiary'])
            ],

            
            'users' => 'required|array',

            'users.*.email' => 'required|string',

            'users.*.password' => 'required|string|min:6|max:40|confirmed',
        ];
    }
}
