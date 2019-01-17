<?php

namespace App\Service\Company;

use App\Repositories\Company\Contracts\SupplierRepositoryContract;
use App\Service\Company\Contrats\SupplierServiceContract;

class SupplierService implements SupplierServiceContract
{
    private $repository;

    public function __construct(SupplierRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function getTotalMonthlyPayment(): float
    {
        return bcdiv(
            $this->repository->allMonthlyPayment()->sum(),
            1,
            2
        );
    }
}
