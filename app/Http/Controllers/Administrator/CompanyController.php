<?php

namespace App\Http\Controllers\Administrator;

use App\Services\Admin\Contracts\CompanyServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CompanyRequest;
use App\Http\Resources\Administrator\CompanyResource;
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

            $data = [
                'url' => route('users.login', [$company->id]),
                'company' => new CompanyResource($company),
            ];

            return responseSuccess(
                $data,
                201,
                'Empresa cadastrada com sucesso!'
            );
        } catch (\Throwable $e) {
            dd($e);
            DB::rollback();
            return responseError(config('errors.default'));
        }
    }
}
