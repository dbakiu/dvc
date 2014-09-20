<?php

Route::group(['before' => 'auth'], function()
{
    Route::resource('home', 'HomeController@index');
});

#Route::get('login', 'SessionController@create');
#Route::get('logout', 'SessionController@destroy');

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