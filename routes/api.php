<?php

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

Route::group([
    'middleware' => ['auth:admins'],
    'prefix' => 'administrators',
    'namespace' => 'Administrator',
], function () {
    Route::resource('admins', 'AdminController', ['only' => ['store', 'destroy']]);

    Route::resource('companies', 'CompanyController', ['only' => ['store']]);
});

Route::group([
    'middleware' => ['auth:users', 'user.has.permission'],
    'prefix' => '{company}',
    'namespace' => 'Supplier',
], function () {
    Route::resource('suppliers', 'SupplierController', ['except' => ['edit', 'show']]);
    
    Route::get('suppliers/total-monthly-payment', 'SupplierController@totalMonthlyPayment');
});

Route::post('administrators/login', 'Auth\AdminLoginController@login');

Route::post('{company}/login', 'Auth\UserLoginController@login')->name('users.login');

Route::get('companies/suppliers/activation/{token}', 'Supplier\ActivationSupplierController@activation')
    ->name('suppliers.activation');
