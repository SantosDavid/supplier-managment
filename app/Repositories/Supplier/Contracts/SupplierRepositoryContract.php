<?php

namespace App\Repositories\Supplier\Contracts;

use App\Models\Tenant\Supplier;

interface SupplierRepositoryContract
{
    public function allMonthlyPayment();

    public function notVerifiedByToken(String $token);
}
