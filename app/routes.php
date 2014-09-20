<?php

Route::group(['before' => 'auth|admin'], function()
{

    Route::resource('/', 'HomeController');



    Route::resource('donation', 'DonationController');
    Route::get('reserves', ['as' => 'reserves.index', 'uses' => 'DonationController@displayReserves']);
    Route::get('reserves/getReserves', 'DonationController@getReserves');
    Route::get('reserves/cities', ['as' => 'reserves.cities', 'uses' => 'DonationController@displayCityReserves']);
    Route::get('reserves/getCityReserves', 'DonationController@getCityReserves');


    Route::post('reserves/getReservesForEvent', 'DonationController@getReservesForEvent');
    Route::get('reserves/getDonorLocations', 'DonorController@getDonorLocations');

    Route::resource('user', 'UserController');
    Route::resource('users', 'UserController');
    Route::get('user/{user}', 'UserController@edit');


});

Route::group(['before' => 'auth'], function(){

    Route::get('profile/index', ['as' => 'profile.index', 'uses' => 'DonorController@displayPublicIndex']);
    Route::get('profile/{donor}', ['as' => 'profile', 'uses' => 'DonorController@displayPublicProfile']);


});

Route::get('login', 'SessionController@create');
Route::get('logout', 'SessionController@destroy');
Route::resource('sessions', 'SessionController'); 