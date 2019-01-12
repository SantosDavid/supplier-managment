<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Administrator\Admin;
use App\Observers\Administrator\AdminObserver;
use App\Models\Company\User;
use App\Observers\Company\UserObserver;

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
