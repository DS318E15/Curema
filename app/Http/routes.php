<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'app'], function () {
    Route::resource('account', 'App\AccountController');
    Route::resource('case', 'App\CaseController');
    Route::resource('contact', 'App\ContactController');
    Route::resource('employee', 'App\EmployeeController');
    Route::resource('lead', 'App\LeadController');
    Route::resource('opportunity', 'App\OpportunityController');

    Route::controller('/', 'App\DashboardController', [
        'getIndex' => 'app.dashboard.index'
    ]);
});

Route::get('/', function () {
    return view('welcome');
});


