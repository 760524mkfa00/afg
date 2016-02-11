<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/projects', ['as' => 'projects','uses' => 'ProjectsController@projects']);
    Route::get('/projects/create', 'ProjectsController@create');
    Route::post('/projects', 'ProjectsController@store');
    Route::get('/projects/{id}/edit', ['as' => 'projects.edit','uses' => 'ProjectsController@edit']);
    Route::get('/projects/{id}/balances', ['as' => 'projects.balances','uses' => 'ProjectsController@balances']);
    Route::post('/projects/{id}', ['as' => 'projects.update','uses' => 'ProjectsController@update']);

    Route::get('/chart',['as' => 'categories', 'uses' => 'ChartsController@chart']);
    Route::get('/chart/comparison',['as' => 'comparison', 'uses' => 'ChartsController@yearComparisonChart']);

    Route::get('/tracking/create/{project}', ['as' => 'tracking.create','uses' => 'TrackingController@create']);
    Route::post('/tracking', 'TrackingController@store');
    Route::get('/tracking/{id}/edit/{project}', ['as' => 'tracking.edit','uses' => 'TrackingController@edit']);
    Route::post('/tracking/{id}', ['as' => 'tracking.update','uses' => 'TrackingController@update']);

    Route::get('/tracking/invoices/{id}', ['as' => 'tracking.invoices', 'uses' => 'TrackingController@invoices']);
    Route::get('/tracking/invoices/create/{team}', ['as' => 'invoice.create','uses' => 'InvoiceController@create']);
    Route::post('/invoices', 'InvoiceController@store');
    Route::get('/invoices/{id}/edit/{team}', ['as' => 'invoice.edit','uses' => 'InvoiceController@edit']);
    Route::post('/invoices/{id}', ['as' => 'invoice.update','uses' => 'InvoiceController@update']);
});
