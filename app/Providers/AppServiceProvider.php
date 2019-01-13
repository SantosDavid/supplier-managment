<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Administrator\Admin;
use App\Observers\Administrator\AdminObserver;
use App\Models\Company\{User, Supplier};
use App\Observers\Company\{UserObserver, SupplierObserver};

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
