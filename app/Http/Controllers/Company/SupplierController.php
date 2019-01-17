<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\SupplierRequest;
use App\Http\Resources\Company\SupplierResource;
use App\Models\Company\Supplier;
use App\Service\Company\Contrats\SupplierServiceContract;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    private $service;

    public function __construct(SupplierServiceContract $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $suppliers = SupplierResource::collection(Supplier::paginate(30));

        return $this->responseSuccess($suppliers, 201, 'Fornecedor criado com sucesso!');
    }

    public function store(SupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $supplier = Supplier::create($request->all());

            DB::commit();

            return $this->responseSuccess(new SupplierResource($supplier), 201, 'Fornecedor criado com sucesso!');
        } catch (\Throwable $e) {
            return $this->responseError(config('errors.default'));
        }
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            DB::beginTransaction();

            $supplier->monthly_payment = $request->monthly_payment;

            $supplier->save();

            DB::commit();

            return $this->responseSuccess(new SupplierResource($supplier), 200, 'Fornecedor atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return $this->responseError('Fornecedor não encontrado');
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
