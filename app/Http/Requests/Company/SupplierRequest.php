<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        \App\Models\Company\Supplier::truncate();
        return [
            
            'name' => 'required|string|min:4|max:255',

            'email' => 'required|string|email|unique:suppliers,email',

            'monthly_payment' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/'
        ];
    }
}
