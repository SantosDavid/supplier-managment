<?php

namespace App\Http\Requests\Company;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Company\Supplier;
use App\Models\Company\ActiveSupplier;

class SupplierRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'name' => 'required|string|min:4|max:255',

            
            'email' => [
                'required', 
                
                'string', 
                
                'email',
                
                Rule::unique('suppliers', 'email')
                    ->where('company_id', Auth()->guard('users')->user()->company->id)
            ],

            'monthly_payment' => 'required|regex:/^[0-9]+(\.[0-9]{1,2})?$/'
        ];
    }
}
