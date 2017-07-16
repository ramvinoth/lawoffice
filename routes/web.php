<?php

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::group(['prefix' => 'api/'], function(){
    Route::resource('caselist', 'CaseListController');
    Route::resource('diary', 'DiaryController');
    Route::resource('calendar', 'CalendarController');
    Route::resource('event', 'EventController');
    
    Route::get('/dashboard', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    
    Route::get('/court/getdata', [
        'uses' => 'CourtController@getData',
        'as' => 'court'
    ]);
    
    Route::get('/caseinfo/petition/show', [
        'uses' => 'CaseListController@getCasePetition',
        'as' => 'petition'
    ]);
    
    Route::post('/caseinfo/petition/create', [
        'uses' => 'CaseListController@saveCasePetition',
        'as' => 'savepetition'
    ]);
    
    Route::delete('/caseinfo/petition/{id}', [
        'uses' => 'CaseListController@deleteCasePetition',
        'as' => 'delete_petition'
    ]);
    
    Route::get('/caseinfo/connected/show', [
        'uses' => 'CaseListController@getConnectedCase',
        'as' => 'connected_case'
    ]);
    
    Route::get('/eventtype/getEventTypes', [
        'uses' => 'EventController@getEventTypes',
        'as' => 'event_types'
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{slug}', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile'
    ]);
    
    Route::get('/caselist', [
        'uses' => 'CaseListController@show',
        'as' => 'caselist'
    ]);
    
    Route::get('/profile/edit/profile', [
        'uses' => 'ProfilesController@edit',
        'as' => 'profile.edit'
    ]);

    Route::post('/profile/update/profile', [
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update'
    ]);

    Route::get('/check_relationship_status/{id}', [
        'uses' => 'FriendshipsController@check',
        'as' => 'check'
    ]);

    Route::get('/add_friend/{id}', [
        'uses' => 'FriendshipsController@add_friend',
        'as' => 'add_friend'
    ]);

    Route::get('/accept_friend/{id}', [
        'uses' => 'FriendshipsController@accept_friend',
        'as' => 'accept_friend'
    ]);

    Route::get('get_unread', function(){
        return Auth::user()->unreadNotifications;
    });

    Route::get('/notifications', [
        'uses' => 'HomeController@notifications',
        'as' => 'notifications'
    ]);

    Route::get('/feed', [
        'uses' => 'FeedsController@feed',
        'as' => 'feed'
    ]);

    Route::post('/create/post', [
        'uses' => 'PostsController@store'
    ]);

    Route::get('/get_auth_user_data', function(){
        return Auth::user();
    });

    Route::get('/like/{id}', [
        'uses' => 'LikesController@like'
    ]);

    Route::get('/unlike/{id}', [
        'uses' => 'LikesController@unlike'
    ]);

    Route::get('/storage/{path}/{file}', [
	'as'=>'image', 
	'uses'=>'ImageController@getImage'
    ]);
});
