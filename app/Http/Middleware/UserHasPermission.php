<?php

namespace App\Http\Middleware;

use Closure;

class UserHasPermission
{
    public function handle($request, Closure $next)
    {
        $company = $request->route('company');

        if (!Auth()->guard('users')->user()->belongsToCompany($company)) {
            return responseError(['Não autorizado'], 403);
        }

        $request->route()->forgetParameter('company');

        return $next($request);
    }
}
