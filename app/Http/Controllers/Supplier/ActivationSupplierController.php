<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Repositories\Company\SupplierRepository;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ActivationSupplierController extends Controller
{
    private $repository;

    public function __construct(SupplierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function activation($token)
    {
        try {
            if (!$supplier = $this->repository->notVerifiedByToken($token)) {
                throw new NotFoundResourceException('Ativação não encontrada!');
            }

            $supplier->actived();

            return view('companies.suppliers.actived', compact('supplier'));
        } catch (NotFoundResourceException $e) {
            $error = $e->getMessage();

            return view('companies.suppliers.error', compact('error'));
        } catch (\Throwable $e) {
            $error = config('errors.default');

            return view('companies.suppliers.error', compact('error'));
        }
    }
}
