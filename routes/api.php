<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
Route::get('/test', function(){
    return Auth::user();
});
Route::post('/login', 'Auth\LoginController@loginApi');
Route::post('/register', 'Auth\RegisterController@registerApi');

Route::group([
    'middleware' => ['auth:api' ]
],
    function () { 


    Route::post('/create-profile','ProfileController@store');
    Route::post('/update-profile','ProfileController@update');
    Route::post('/delete-profile','ProfileController@delete');
    Route::get('/get-profile','ProfileController@getProfile');
    Route::get('/get-profiles','ProfileController@getProfiles');

    Route::post('/create-cast','CastController@store');
    Route::post('/update-cast','CastController@update');
    Route::post('/delete-cast','CastController@delete');
    Route::get('/get-cast','CastController@getCast');
    Route::get('/get-casts','CastController@getCasts');

    Route::post('/create-state','StateController@store');
    Route::post('/update-state','StateController@update');
    Route::post('/delete-state','StateController@delete');
    Route::get('/get-state','StateController@getState');
    Route::get('/get-states','StateController@getStates');

    Route::post('/create-city','CityController@store');
    Route::post('/update-city','CityController@update');
    Route::post('/delete-city','CityController@delete');
    Route::get('/get-city','CityController@getCity');
    Route::get('/get-citys','CityController@getCitys');

    Route::post('/create-country','CountryController@store');
    Route::post('/update-country','CountryController@update');
    Route::post('/delete-country','CountryController@delete');
    Route::get('/get-country','CountryController@getCountry');
    Route::get('/get-countrys','CountryController@getCountrys');
    
    Route::post('/create-sector','SectorController@store');
    Route::post('/update-sector','SectorController@update');
    Route::post('/delete-sector','SectorController@delete');
    Route::get('/get-sector','SectorController@getCountry');
    Route::get('/get-sectors','SectorController@getCountrys');

    Route::get('/profiles-you-visited','RecentlyViewedController@profilesYouVisied');
    Route::get('/profiles-visited-you','RecentlyViewedController@profilesVisiedYou');

    Route::get('user-plan','UserSubscriptionController@userPlan');
      
});