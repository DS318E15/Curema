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

     // Employee
    Route::get('employee/trash', 'App\EmployeeController@trash')->name('app.employee.trash');
    Route::get('employee/{id}/activities', 'App\EmployeeController@activities')->name('app.employee.activities');
    Route::put('employee/{id}/restore', 'App\EmployeeController@restore')->name('app.employee.restore');
    Route::resource('employee', 'App\EmployeeController');

    // Account
    Route::get('account/trash', 'App\AccountController@trash')->name('app.account.trash');
    Route::get('account/{id}/activities', 'App\AccountController@activities')->name('app.account.activities');
    Route::put('account/{id}/restore', 'App\AccountController@restore')->name('app.account.restore');
    Route::resource('account', 'App\AccountController');

    // Contact
    Route::get('contact/trash', 'App\ContactController@trash')->name('app.contact.trash');
    Route::get('contact/{id}/activities', 'App\ContactController@activities')->name('app.contact.activities');
    Route::put('contact/{id}/restore', 'App\ContactController@restore')->name('app.contact.restore');
    Route::resource('contact', 'App\ContactController');

    // Lead
    Route::get('lead/trash', 'App\LeadController@trash')->name('app.lead.trash');
    Route::get('lead/{id}/activities', 'App\LeadController@activities')->name('app.lead.activities');
    Route::put('lead/{id}/restore', 'App\LeadController@restore')->name('app.lead.restore');
    Route::resource('lead', 'App\LeadController');

    // Opportunity
    Route::get('opportunity/trash', 'App\OpportunityController@trash')->name('app.opportunity.trash');
    Route::get('opportunity/{id}/activities', 'App\OpportunityController@activities')->name('app.opportunity.activities');
    Route::put('opportunity/{id}/restore', 'App\OpportunityController@restore')->name('app.opportunity.restore');
    Route::resource('opportunity', 'App\OpportunityController');

    // Ticket
    Route::get('ticket/trash', 'App\TicketController@trash')->name('app.ticket.trash');
    Route::get('ticket/{id}/activities', 'App\TicketController@activities')->name('app.ticket.activities');
    Route::put('ticket/{id}/restore', 'App\TicketController@restore')->name('app.ticket.restore');
    Route::resource('ticket', 'App\TicketController');

    // Call
    Route::get('call/{id}/activities', 'App\CallController@activities')->name('app.call.activities');
    Route::resource('call', 'App\CallController', ['exclude' => 'destroy']);

    // Email
    Route::get('email/{id}/activities', 'App\EmailController@activities')->name('app.email.activities');
    Route::resource('email', 'App\EmailController', ['exclude' => 'destroy']);




    Route::get('lead/{id}/conversion', ['uses' => 'App\LeadController@conversion', 'as' => 'app.lead.conversion']);
    Route::post('lead/{id}/convert', ['uses' => 'App\LeadController@convert', 'as' => 'app.lead.convert']);
    Route::put('opportunity/{id}/stage', ['uses' => 'App\OpportunityController@stage', 'as' => 'app.opportunity.stage']);

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