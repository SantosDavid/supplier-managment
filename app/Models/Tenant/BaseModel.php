<?php

namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Models\Tenant\Scopes\CompanyScope;

abstract class BaseModel extends Model
{
    use Cachable;

    protected static function boot()
    {
        parent::boot();

        config(['laravel-model-caching.cache-prefix' => Auth()->guard('users')->user()->company->id ?? '']);

        static::addGlobalScope(new CompanyScope);
    }
}