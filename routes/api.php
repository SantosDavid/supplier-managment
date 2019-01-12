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
    'middleware' => ['jwt.auth'],
    'prefix' => 'administrators',
    'namespace' => 'Administrator',
], function () {

    Route::resource('admins', 'AdminController', ['only' => ['store', 'destroy']]);

    Route::resource('companies', 'CompanyController');
});

Route::post('administrators/login', 'Auth\AdministratorController@login');
