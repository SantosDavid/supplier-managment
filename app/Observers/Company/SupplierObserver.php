<?php

namespace App\Observers\Company;

use App\Jobs\SendEmailSupplier;
use App\Models\Company\Supplier;

class SupplierObserver
{
    public function creating(Supplier $supplier)
    {
        $supplier->company_id = Auth()->guard('users')->user()->company->id;
    }

    public function created(Supplier $supplier)
    {
        $activation = $supplier->active()->create(['token' => random_unique()]);

        SendEmailSupplier::dispatch($activation);
    }
}
