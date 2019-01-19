<?php

namespace App\Http\Resources\Administrator;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\Tenant\UserResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            
            'id' => $this->id,

            'name' => $this->name,

            'phone' => $this->phone,

            'cnpj' => $this->cnpj,

            'users' => UserResource::collection($this->users),

            'addresses' => AddressResource::collection($this->addresses),
        ];
    }
}
