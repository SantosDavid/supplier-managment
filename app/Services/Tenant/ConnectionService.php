<?php

namespace App\Services\Tenant;

use Config;
use App\Models\Company\Company;

class ConnectionService
{
    public function change(Company $company)
    {
        config([
            
            'database.connections.' . $company->prefix =>  [
                
                'driver' => 'mysql',
                
                'host' => env('DB_HOST', '127.0.0.1'),
                
                'port' => env('DB_PORT', '3306'),
                
                'database' => $company->prefix,
                
                'username' => env('DB_USERNAME', ''),
                
                'password' => env('DB_PASSWORD', ''),
                
                'unix_socket' => env('DB_SOCKET', ''),
                
                'charset' => 'utf8mb4',
                
                'collation' => 'utf8mb4_unicode_ci',
                
                'prefix' => '',
                
                'strict' => true,
                
                'engine' => null,
            ],
        ]);

        Config::set('database.default', $company->prefix);
    }
}