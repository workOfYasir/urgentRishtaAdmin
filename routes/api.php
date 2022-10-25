<?php

use App\Models\Cast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
Route::get('/test', function(){
    return Auth::user();
});
Route::post('/login', 'Auth\LoginController@loginApi');
Route::post('/register', 'Auth\RegisterController@registerApi');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword');

Route::group([
    'middleware' => ['auth:api' ]
],
    function () { 

    Route::post('/create-profile','ProfileController@store');
    Route::post('/update-profile','ProfileController@update');
    Route::post('/delete-profile','ProfileController@delete');
    Route::post('/get-profile','ProfileController@getProfile');
    Route::post('/get-profiles','ProfileController@getProfiles');
    Route::post('/get-new-profiles','ProfileController@getNewProfiles');
    Route::post('/get-searched-profiles','ProfileController@getSearchedProfiles');
    Route::post('/pictures-settings','ProfileController@pictureSettings');
    Route::post('/contact-no','ProfileController@contactView');
    Route::post('filters','ProfileController@filters');
    Route::post('/get-profiles-matches','ProfileController@getProfilesMatches');
    Route::post('/get-picture','ProfileController@picture');
    Route::post('/get-basic-search','ProfileController@getBasicSearch');
    Route::post('/get-advance-search','ProfileController@getAdvanceSearch');
    Route::get('/age','ProfileController@birth');
    Route::get('/get-today-profile','ProfileController@getTodayProfile');
    Route::post('/friend-request','ProfileController@sendRequest');
    Route::get('/request-list','ProfileController@requestList');
    Route::post('/request-action','ProfileController@friendRequestAction');
    Route::post('/all-sent-requests','ProfileController@allSentFriendRequestList');
    Route::post('/all-recieved-requests','ProfileController@allRecievedFriendRequestList');
    Route::post('/profile-image','ProfileController@profileImageStore');

    Route::post('/update-partner','ProfileController@partnerStore');

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

    Route::post('/recent-visit','RecentlyViewedController@store');
    Route::get('/profiles-you-visited','RecentlyViewedController@profilesYouVisited');
    Route::get('/profiles-visited-you','RecentlyViewedController@profilesVisitedYou');

    Route::get('all-plans','PlanController@plans');
    Route::post('create-plan','PlanController@store');

    Route::get('user-plan','UserSubscriptionController@userPlan');
    Route::post('user-subscription','UserSubscriptionController@store');
    Route::post('user-premium','UserSubscriptionController@premiumUser');
    Route::post('/profile-stats','ProfileController@profileStat');

    Route::post('fetchUsers','ChatsController@fetchUsers');

    Route::get('/', 'ChatsController@index');
    Route::post('fetchmessages', 'ChatsController@fetchMessages');
    Route::post('messages', 'ChatsController@sendMessage');

    Route::get('/images','ProfileController@getImage');


    });
Route::post('/forgot-password-email-match','Admin\UsersController@forgotPasswordEmail');
Route::post('/forgot-password','Admin\UsersController@forgotPassword');

Route::get('/get-data','ProfileController@getData');

Route::get('/get-sectors','SectorController@getSectors');
Route::get('/get-religions','ReligionController@getReligions');

Route::get('/get-countrys','CountryController@getCountrys');

Route::post('/get-states-by-country','StateController@getStatesByCountry');
Route::get('/get-states','StateController@getStates');

Route::post('/get-cities-by-state','CityController@getCitesByStates');
Route::get('/get-cities','CityController@getCities');

Route::post('/get-partner-matches','ProfileController@getPartnerMatch');

Route::post('/image-store','ProfileController@imageStore');
Route::post('/image-delete','ProfileController@deleteImage');

Route::get('cast-add',function(){
    $data =[
        ['name'=>'Arain'],
        ['name'=>'Abbasi'],
        ['name'=>'Ansari'],
        ['name'=>'Awan'],
        ['name'=>'Bahmani'],
        ['name'=>'Bajwa'],
        ['name'=>'Basra'],
        ['name'=>'Baig'],
        ['name'=>'Bhati'],
        ['name'=>'Barsar'],
        ['name'=>'Bloch'],
        ['name'=>'Buttar'],
        ['name'=>'Chaudhry'],
        ['name'=>'Chatha'],
        ['name'=>'Chauhan'],
        ['name'=>'Chughtai'],
        ['name'=>'Derawal'],
        ['name'=>'Dhariwal'],
        ['name'=>'Dhillon'],
        ['name'=>'Dogar'],
        ['name'=>'Duggal'],
        ['name'=>'Farooqi'],
        ['name'=>'Gakhar'],
        ['name'=>'Gill'],
        ['name'=>'Gujjar'],
        ['name'=>'Hashmi'],
        ['name'=>'Hyderabadi'],
        ['name'=>'Janjua'],
        ['name'=>'Jutt'],
        ['name'=>'Johiya'],
        ['name'=>'Kathia'],
        ['name'=>'Kahloon'],
        ['name'=>'Khan Punjabi'],
        ['name'=>'Kharal'],
        ['name'=>'Kayani '],
        ['name'=>'Khokhar'],
        ['name'=>'Kamboh'],
        ['name'=>'Kirmani'],
        ['name'=>'Khawaja'],
        ['name'=>'Khilji'],
        ['name'=>'Langrial'],
        ['name'=>'Lodhi'],
        ['name'=>'Machi'],
        ['name'=>'Mahar'],
        ['name'=>'Memon'],
        ['name'=>'Makhdoom'],
        ['name'=>'Malik Awan'],
        ['name'=>'Malik Teli'],
        ['name'=>'Malik KakkaZai '],
        ['name'=>'Meo'],
        ['name'=>'Mirza'],
        ['name'=>'Mian'],
        ['name'=>'Minhas'],
        ['name'=>'Mughal'],
        ['name'=>'Rajput Local'],
        ['name'=>'Rajput Migrated '],
        ['name'=>'Rajput Bhatti'],
        ['name'=>'Rehmani '],
        ['name'=>'Naqvi'],
        ['name'=>'Paracha'],
        ['name'=>'Pathan Pashto speaking '],
        ['name'=>'Sheikh (Punjabi)'],
        ['name'=>'Qureshi'],
        ['name'=>'Raja Hajam'],
        ['name'=>'Ranjha'],
        ['name'=>'Raye'],
        ['name'=>'Sangha'],
        ['name'=>'Sanghera'],
        ['name'=>'Satti'],
        ['name'=>'sehgal'],
        ['name'=>'sukhera'],
        ['name'=>'Sethi'],
        ['name'=>'Sangha'],
        ['name'=>'sheikh Punjabi '],
        ['name'=>'Sheikh Urdu speaking '],
        ['name'=>'Sial'],
        ['name'=>'Siddiqui'],
        ['name'=>'Singh'],
        ['name'=>'Sidhi '],
        ['name'=>'Sindu '],
        ['name'=>'Sandhu'],
        ['name'=>'Shah'],
        ['name'=>'Syed'],
        ['name'=>'Tiwana '],
        ['name'=>'Tarar'],
        ['name'=>'Urdu speaking '],
        ['name'=>'Virk'],
        ['name'=>'Warraich'],
        ['name'=>'Butt'],
        ['name'=>'Dar'],
        ['name'=>'Kashmiri '],
        ['name'=>'Khan  Urdu speaking'],
        ['name'=>'Lone'],
        ['name'=>'Mir'],
        ['name'=>'Wayne'],
        ['name'=>'Other']
    ];
    // return $data;
Cast::insert($data);
});



