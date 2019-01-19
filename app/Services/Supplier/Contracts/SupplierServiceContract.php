<?php

namespace App\Services\Supplier\Contrats;

use App\Repositories\Supplier\Contracts\SupplierRepositoryContract;

interface SupplierServiceContract
{
    public function __construct(SupplierRepositoryContract $repository);

    public function getTotalMonthlyPayment(): float;
}
