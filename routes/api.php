<?php

use App\Models\Company\Company;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

 Route::get('teste', function () {
    return factory(\App\Models\Company\Company::class)->create();
});


Route::group([
    'middleware' => ['auth:admins'],
    'prefix' => 'administrators',
    'namespace' => 'Administrator',
], function () {
    Route::resource('admins', 'AdminController', ['only' => ['store', 'destroy']]);

    Route::resource('companies', 'CompanyController', ['only' => ['store']]);
});

Route::group([
    'middleware' => ['auth:users'],
    'prefix' => 'companies',
    'namespace' => 'Company',
], function () {
    Route::resource('suppliers', 'SupplierController', ['except' => ['edit', 'update', 'show']]);
    
    Route::get('suppliers/total-monthly-payment', 'SupplierController@totalMonthlyPayment');
});

Route::post('administrators/login', 'Auth\AdministratorController@login');

Route::post('companies/login', 'Auth\UserController@login');

Route::get('companies/suppliers/activation/{token}', 'Company\ActivationSupplierController@activation')
    ->name('suppliers.activation');
