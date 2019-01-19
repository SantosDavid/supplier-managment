<?php

namespace App\Observers\Supplier;

use App\Jobs\SendEmailSupplier;
use App\Models\Tenant\Supplier;

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
