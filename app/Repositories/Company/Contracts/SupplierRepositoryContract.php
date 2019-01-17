<?php

namespace App\Repositories\Company\Contracts;

use App\Models\Company\Supplier;

interface SupplierRepositoryContract
{
    public function allMonthlyPayment();

    public function notVerifiedByToken(String $token);
}