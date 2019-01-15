<?php

namespace App\Repositories\Company;

use App\Models\Company\Supplier;

class SupplierRepository
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