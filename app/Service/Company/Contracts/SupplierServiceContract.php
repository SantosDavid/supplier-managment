<?php

namespace App\Service\Company\Contrats;

use App\Repositories\Company\Contracts\SupplierRepositoryContract;

interface SupplierServiceContract
{
    public function __construct(SupplierRepositoryContract $repository);

    public function getTotalMonthlyPayment(): float;
}
