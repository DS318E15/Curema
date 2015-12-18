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

Route::group(['prefix' => 'app', 'middleware' => 'auth'], function () {
    $resources = [
        'opportunity' => 'App\OpportunityController',
        'lead' => 'App\LeadController',
        'account' => 'App\AccountController',
        'contact' => 'App\ContactController',
        'ticket' => 'App\TicketController',
    ];

    foreach ($resources as $route => $controller) {
        Route::post($route . '/{' . $route . '}/destroy', ['uses' => $controller . '@destroy', 'as' => 'app.' . $route . '.destroy']);
        Route::post($route . '/{' . $route . '}/restore', ['uses' => $controller . '@restore', 'as' => 'app.' . $route . '.restore']);
        Route::get($route . '/trash', ['uses' => $controller . '@trash', 'as' => 'app.' . $route . '.trash']);
        Route::resource($route, $controller, ['except' => 'destroy']);
    }

    Route::resource('call', 'App\CallController');
    Route::resource('email', 'App\EmailController');

    Route::resource('employee', 'App\EmployeeController', [
        'only' => ['index', 'show']
    ]);

    Route::controller('/', 'App\DashboardController', [
        'getIndex' => 'app.dashboard.index'
    ]);
});

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('/', function () {
    return view('home');
});