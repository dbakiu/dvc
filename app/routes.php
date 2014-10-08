<?php

Route::group(['before' => 'auth'], function()
{
    Route::resource('home', 'HomeController');
    Route::resource('employee', 'EmployeeController');
    Route::post('employee/{employee}/check', ['as' => 'employee.check', 'uses' => 'EmployeeController@checkEarnings']);
    Route::get('wages', ['as' => 'wages', 'uses' => 'EmployeeController@displayEmployeeWages' ]);
    Route::post('wages/check', ['as' => 'wages.check', 'uses' => 'EmployeeController@displayEmployeeWages' ]);
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

    Route::get('restore', ['as' => 'database.restore', function() {
         // Empty all tables bar the users
         Vehicle::truncate();
         Expense::truncate();
         Invoice::truncate();
         InvoiceElement::truncate();
         Employee::truncate();

         // Seed the database from the latest seed file.
         Artisan::call('db:seed', ['--force' => true]);
        return Redirect::to('home')->with('message', 'The database has been emptied and restored the latest backup');
    }]);

    });

Route::resource('/', 'SessionController@index');
Route::resource('sessions', 'SessionController');

Route::get('login', ['as' => 'login', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionController@destroy']);


// Remove this section once the admin account is set up.
Route::get('/newAdmin', function() {
    return View::make('home.admin');
});

Route::post('/createAdmin', ['as' => 'create.admin', function(){
    $admin = new User();
    $admin->name = Input::get('name');
    $admin->id = str_random(50);
    $admin->password = Hash::make(Input::get('password'));
    $admin->save();
    return Redirect::to('login')->with('message', 'The admin account has been successfully created.');
}]);

