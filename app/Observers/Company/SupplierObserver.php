<?php

namespace App\Observers\Company;

use App\Models\Company\Supplier;
use App\Jobs\SendEmailSupplier;

class SupplierObserver
{
    public function creating(Supplier $supplier)
    {
        SendEmailSupplier::dispatch($supplier);
    }
}
