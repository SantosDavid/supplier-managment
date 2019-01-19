<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierRequest;
use App\Http\Resources\Tenant\SupplierResource;
use App\Models\Tenant\Supplier;
use App\Services\Supplier\Contrats\SupplierServiceContract;
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

        return responseSuccess($suppliers, 201, '');
    }

    public function store(SupplierRequest $request)
    {
        try {
            DB::beginTransaction();

            $supplier = Supplier::create($request->all());

            DB::commit();

            return responseSuccess(new SupplierResource($supplier), 201, 'Fornecedor criado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollback();
            return responseError(config('errors.default'));
        }
    }

    public function update(SupplierRequest $request, $id)
    {
        try {
            $supplier = Supplier::findOrFail($id);

            DB::beginTransaction();

            $this->service->updateMonthlyPayment(
                $supplier,
                $request->monthly_payment
            );

            DB::commit();

            return responseSuccess(new SupplierResource($supplier), 200, 'Fornecedor atualizado com sucesso!');
        } catch (ModelNotFoundException $e) {
            DB::rollback();
            return responseError('Fornecedor não encontrado');
        } catch (\Throwable $e) {
            DB::rollback();
            return responseError(config('errors.default'));
        }
    }

    public function destroy($id)
    {
        try {
            Supplier::destroy($id);

            return responseSuccess([], 200, 'Fornecedor deletado com sucesso!');
        } catch (\Throwable $e) {
            DB::rollback();
            return responseError(config('errors.default'));
        }
    }

    public function totalMonthlyPayment()
    {
        $total = $this->service->getTotalMonthlyPayment();

        return responseSuccess(['total' => $total], 200, '');
    }
}
