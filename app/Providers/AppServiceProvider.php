<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Administrator\Admin;
use App\Observers\Administrator\AdminObserver;
use App\Models\Tenant\User;
use App\Models\Tenant\Supplier;
use App\Observers\Supplier\SupplierObserver;
use App\Observers\User\UserObserver;
use App\Services\Supplier\Contrats\SupplierServiceContract;
use App\Services\Supplier\SupplierService;
use App\Repositories\Supplier\SupplierRepository;
use App\Repositories\Supplier\Contracts\SupplierRepositoryContract;
use App\Services\Admin\CompanyService;
use App\Services\Admin\Contracts\CompanyServiceContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Admin::observe(AdminObserver::class);

        User::observe(UserObserver::class);

        Supplier::observe(SupplierObserver::class);

        $this->app->bind(SupplierServiceContract::class, SupplierService::class);
        
        $this->app->bind(SupplierRepositoryContract::class, SupplierRepository::class);

        $this->app->bind(CompanyServiceContract::class, CompanyService::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
