<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->method()) {

            case 'POST':
                return [

                    'name' => 'required|string|min:4|max:255',

                    'email' => [
                        'required',

                        'string',

                        'email',

                        Rule::unique('suppliers', 'email')
                            ->where('company_id', Auth()->guard('users')->user()->company->id),
                    ],

                    'monthly_payment' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
                ];

            case 'PUT':

                return [
                    'monthly_payment' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/',
                ];
        }
    }
}
