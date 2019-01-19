<?php

namespace App\Http\Controllers\Administrator;

use App\Services\Admin\Contracts\CompanyServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use DB;

class CompanyController extends Controller
{
    private $service;

    public function __construct(CompanyServiceContract $service)
    {
        $this->service = $service;
    }

    public function store(CompanyRequest $request)
    {
        try {
            DB::beginTransaction();

            $company = $this->service->create(
                $request->all(), 
                $request->addresses, 
                $request->users
            );

            DB::commit();

            return responseSuccess(
                new CompanyResource($company),
                201,
                'Empresa cadastrada com sucesso!'
            );
        } catch (\Throwable $e) {
            DB::rollback();
            return responseError(config('errors.default'));
        }
    }
}
