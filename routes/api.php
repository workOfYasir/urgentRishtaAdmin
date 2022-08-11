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
    Route::post('/get-profile','ProfileController@getProfile');
    Route::post('/get-profiles','ProfileController@getProfiles');

    Route::post('/create-cast','CastController@store');
    Route::post('/update-cast','CastController@update');
    Route::post('/delete-cast','CastController@delete');
    Route::post('/get-cast','CastController@getCast');
    Route::get('/get-casts','CastController@getCasts');

    Route::post('/create-country','CountryController@store');
    Route::post('/update-country','CountryController@update');
    Route::post('/delete-country','CountryController@delete');
    Route::post('/get-country','CountryController@getCountry');
    Route::get('/get-countrys','CountryController@getCountrys');

    Route::post('/create-state','StateController@store');
    Route::post('/update-state','StateController@update');
    Route::post('/delete-state','StateController@delete');
    Route::post('/get-state','StateController@getState');
    
    Route::post('/create-city','CountryController@store');
    Route::post('/update-city','CountryController@update');
    Route::post('/delete-city','CountryController@delete');
    Route::post('/get-city','CountryController@getCity');
    
    Route::post('/create-city','CityController@store');
    Route::post('/update-city','CityController@update');
    Route::post('/delete-city','CityController@delete');
    Route::post('/get-city','CityController@getCity');
    Route::get('/get-cities','CityController@getCities');
    

    Route::post('/create-sector','SectorController@store');
    Route::post('/update-sector','SectorController@update');
    Route::post('/delete-sector','SectorController@delete');
    Route::post('/get-sector','SectorController@getCountry');

    Route::post('/create-religion','ReligionController@store');
    Route::post('/update-religion','ReligionController@update');
    Route::post('/delete-religion','ReligionController@delete');
    Route::post('/get-religion','ReligionController@getCountry');

    Route::post('/recent-visit','RecentlyViewedController@store');
    Route::get('/profiles-you-visited','RecentlyViewedController@profilesYouVisited');
    Route::get('/profiles-visited-you','RecentlyViewedController@profilesVisitedYou');

    Route::get('all-plans','PlanController@plans');
    Route::post('create-plan','PlanController@store');

    Route::get('user-plan','UserSubscriptionController@userPlan');
    Route::post('user-subscription','UserSubscriptionController@store');
});
Route::get('/get-sectors','SectorController@getSectors');
Route::get('/get-religions','ReligionController@getReligions');

Route::get('/get-countrys','CountryController@getCountrys');

Route::post('/get-states-by-country','StateController@getStatesByCountry');
Route::get('/get-states','StateController@getStates');

Route::post('/get-cities-by-state','CityController@getCitesByStates');
Route::get('/get-cities','CityController@getCities');

Route::post('/get-partner-matches','ProfileController@getPartnerMatch');
Route::post('/image-store','ProfileController@imageStore');