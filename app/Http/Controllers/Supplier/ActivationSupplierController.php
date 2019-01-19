<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Repositories\Supplier\Contracts\SupplierRepositoryContract;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ActivationSupplierController extends Controller
{
    private $repository;

    public function __construct(SupplierRepositoryContract $repository)
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

            return responseSuccess([], 200, 'Ativação efetuada com sucesso!');
        } catch (NotFoundResourceException $e) {
            return responseError([], 400, $e->getMessage());
        } catch (\Throwable $e) {
            return responseError([], 500, config('errors.default'));
        }
    }
}
