<?php

namespace App\Http\Resources\Company;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            
            'street' => $this->street,
            
            'number' => $this->number,
            
            'neighborhood' => $this->neighborhood,
            
            'city' => $this->city,
            
            'zipcode' => $this->zipcode,
            
            'type' => $this->type,
        ];
    }
}
