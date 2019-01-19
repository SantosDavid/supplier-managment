<?php

namespace App\Services\Supplier;

use App\Repositories\Supplier\Contracts\SupplierRepositoryContract;
use App\Services\Supplier\Contrats\SupplierServiceContract;
use App\Models\Tenant\Supplier;

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

    public function updateMonthlyPayment(Supplier $supplier, float $monthlyPayment)
    {
        $supplier->update(['monthly_payment' => $monthlyPayment]);
    }
}
