<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Administrator\Admin;
use App\Observers\Administrator\AdminObserver;
use App\Models\Company\{User, Supplier};
use App\Observers\Company\{UserObserver, SupplierObserver};
use App\Service\Company\Contrats\SupplierServiceContract;
use App\Service\Company\SupplierService;
use App\Repositories\Company\SupplierRepository;
use App\Repositories\Company\Contracts\SupplierRepositoryContract;

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
