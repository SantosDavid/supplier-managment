<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            
            'id' => $this->id,

            'name' => $this->name,

            'email' => $this->email,

            'monthly_payment' => $this->monthly_payment,
        ];
    }
}
