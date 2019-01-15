<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class ActiveSupplier extends Model
{
    protected $fillable = [
        'token',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
