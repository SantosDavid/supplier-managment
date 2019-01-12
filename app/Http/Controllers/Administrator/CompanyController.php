<?php

namespace App\Http\Controllers\Administrator;

use DB;
use App\Http\Requests\Administrator\CompanyRequest;
use App\Http\Controllers\Controller;
use App\Models\Company\Company;
use App\Events\CompanyCreated;

class CompanyController extends Controller
{
    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();

        $company = Company::create($request->all());

        foreach ($request->addresses ?? [] as $address) {
            $company->addresses()->create($address);
        }
        
        event(new CompanyCreated($company, $request->users));
    }
}
