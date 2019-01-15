<?php

namespace App\Models\Company\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (Auth()->guard('users')->check()) {
            $builder->where('company_id', Auth()->guard('users')->user()->company->id);
        }
    }
}
