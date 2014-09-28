<?php

Route::group(['before' => 'auth'], function()
{
    Route::resource('home', 'HomeController@index');
    Route::resource('employee', 'EmployeeController');
    Route::resource('invoice', 'InvoiceController');
    Route::get('invoice/{invoice}/pdf', ['as' => 'invoice.download', 'uses' => 'InvoiceController@download']);
    Route::resource('vehicle', 'VehicleController');
    Route::resource('balance', 'BalanceController');
    Route::resource('expense', 'ExpenseController');
});

Route::resource('/', 'SessionController@index');
Route::resource('sessions', 'SessionController');

Route::get('login', ['as' => 'login', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionController@destroy']);




/*
Route::get('/createTestUser', function(){
    $admin = new User();
    $admin->name = 'db';
    $admin->id = str_random(50);
    $admin->password = Hash::make('asd');
    $admin->save();
    echo "Done.";
});

*/