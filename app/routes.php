<?php

Route::group(['before' => 'auth'], function()
{
    Route::resource('home', 'HomeController');
    Route::resource('employee', 'EmployeeController');
    Route::post('employee/{employee}/check', ['as' => 'employee.check', 'uses' => 'EmployeeController@checkEarnings']);
    Route::resource('invoice', 'InvoiceController');
    Route::get('invoice/{invoice}/pdf', ['as' => 'invoice.download', 'uses' => 'InvoiceController@download']);
    Route::resource('vehicle', 'VehicleController');
    Route::resource('balance', 'BalanceController');
    Route::post('balance/check', ['as' => 'balance.check', 'uses' => 'BalanceController@checkBalance']);
    Route::resource('expense', 'ExpenseController');

    Route::get('backup', ['as' => 'database.backup', function(){
        DbExportHandler::migrate()->ignore('users')->seed();
        return Redirect::to('home')->with('message', 'The database has been backed up.');
    }]);

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