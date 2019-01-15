<?php

namespace App\Models\Company;

use App\Models\BaseModel;

class ActiveSupplier extends BaseModel
{
    protected $fillable = [
        'token',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
