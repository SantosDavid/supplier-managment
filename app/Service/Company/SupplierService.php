<?php

namespace App\Service\Company;

use App\Repositories\Company\SupplierRepository;

class SupplierService
{
    private $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getTotalMonthlyPayment()
    {
        return bcdiv(
            $this->repository->allMonthlyPayment()->sum(), 
            1, 
            2
        );
    }
}
