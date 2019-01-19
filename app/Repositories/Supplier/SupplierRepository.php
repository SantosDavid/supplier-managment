<?php

namespace App\Repositories\Supplier;

use App\Models\Tenant\Supplier;
use App\Repositories\Supplier\Contracts\SupplierRepositoryContract;

class SupplierRepository implements SupplierRepositoryContract
{
    public function allMonthlyPayment()
    {
        return Supplier::verified()->pluck('monthly_payment');
    }

    public function notVerifiedByToken(String $token)
    {
        return Supplier::where('verified', '0')
            ->whereHas('active', function ($q) use ($token) {
                $q->where('token', $token);
            })
            ->first();
    }
}