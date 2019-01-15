<?php

namespace App\Http\Controllers\Company;

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

            return $this->responseSuccess([], 200, 'Fornecedor ativado com sucesso!');

        } catch (NotFoundResourceException $e) {

            return $this->responseError($e->getMessage(), 404);

        } catch (\Throwable $e) {

            return $this->responseError(config('errors.default'));
        }
    }
}
