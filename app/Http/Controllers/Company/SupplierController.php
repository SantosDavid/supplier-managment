<?php

namespace App\Http\Controllers\Company;

use DB;
use App\Http\Requests\Company\SupplierRequest;
use App\Http\Controllers\Controller;
use App\Models\Company\Supplier;

class SupplierController extends Controller
{
    public function store(SupplierRequest $request)
    {
        DB::beginTransaction();

        $supplier = Supplier::create($request->all());

        DB::commit();
    }
}
