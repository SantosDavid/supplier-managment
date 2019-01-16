<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company\Company;
use DB;

class CompanyController extends Controller
{
    public function store(CompanyRequest $request)
    {
        try {
            DB::beginTransaction();

            $company = Company::create($request->all());

            foreach ($request->addresses as $address) {
                $company->addresses()->create($address);
            }

            foreach ($request->users as $user) {
                $company->users()->create($user);
            }

            DB::commit();

            return $this->responseSuccess(
                new CompanyResource($company),
                201,
                'Empresa cadastrada com sucesso!'
            );
        } catch (\Throwable $e) {
            return $this->responseError(config('errors.default'));
        }
    }
}
