<?php

namespace App\Services\Tenant;

use DB;
use Artisan;
use App\Models\Company\Company;
use App\Models\Company\User;

class DatabaseService
{
    private $connectionService;

    public function __construct(ConnectionService $connectionService)
    {
        $this->connectionService;
    }

    public function provision(Company $company, $users)
    {
        DB::statement('CREATE DATABASE ' . config('app.name') . '_' . $company->prefix);

        $this->connectionService->change($company);

        Artisan::call('migrate', ['--seed' => true]);

        DB::beginTransaction();

        foreach ($users as $user) {
            User::create($user);
        }

        DB::commit();
    }
}