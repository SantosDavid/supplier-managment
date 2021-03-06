<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\AdminRequest;
use App\Http\Resources\Administrator\AdminResource;
use App\Models\Administrator\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminController extends Controller
{
    public function store(AdminRequest $request)
    {
        try {
            $admin = Admin::create($request->all());

            return responseSuccess(new AdminResource($admin), 201, 'Administrador criado com sucesso!');
        } catch (\Throwable $e) {
            return responseError(config('errors.default'));
        }
    }

    public function destroy($id)
    {
        try {
            $admin = Admin::findOrFail($id);

            $admin->delete();

            return responseSuccess([], 200, 'Administrador deletado com sucesso!');
        } catch (ModelNotFoundException $e) {
            return responseError('Administrador não encontrado!', 404);
        } catch (\Throwable $e) {
            return responseError(config('errors.default'));
        }
    }
}
