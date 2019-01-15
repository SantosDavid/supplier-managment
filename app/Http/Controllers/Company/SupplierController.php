<?php

namespace App\Http\Controllers\Company;

use DB;
use App\Http\Requests\Company\SupplierRequest;
use App\Http\Controllers\Controller;
use App\Models\Company\Supplier;
use App\Http\Resources\Company\SupplierResource;
use App\Models\Company\User;
use App\Service\Company\SupplierService;

class SupplierController extends Controller
{
    private $service;

    public function __construct(SupplierService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return SupplierResource::collection(Supplier::paginate(30));
    }

    public function store(SupplierRequest $request)
    {
        try {
            
            DB::beginTransaction();
    
            $supplier = Supplier::create($request->all());
    
            DB::commit();

            return new SupplierResource($supplier);
        
        } catch (\Throwable $e) {

            return $this->responseError(config('errors.default'));
        }
    }

    public function destroy($id)
    {
        try {

            Supplier::destroy($id);

            return $this->responseSuccess([], 200, 'Fornecedor deletado com sucesso!');

        } catch (\Throwable $e) {

            return $this->responseError(config('errors.default'));
        }
    }

    public function totalMonthlyPayment()
    {
        $total = $this->service->getTotalMonthlyPayment();

        return $this->responseSuccess(['total' => $total], 200, '');
    }
}
