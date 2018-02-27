<?php

Route::get('/', function () {
    return view('layouts.app');
});
//Auth::routes();

Route::group(['prefix' => 'api/', 'middleware' => 'auth'], function(){
    Route::resource('caselist', 'CaseListController');
    Route::resource('diary', 'DiaryController');
    Route::resource('library', 'LibraryController');
    Route::resource('calendar', 'CalendarController');
    Route::resource('event', 'EventController');
    Route::resource('eventtype', 'EventTypeController');
    Route::resource('hearing', 'HearingsController');
    Route::resource('users', 'UsersController');
    Route::resource('documents', 'DocumentsController');
    
    Route::get('/dashboard', [
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
    
    Route::get('/court/getdata', [
        'uses' => 'CourtController@getData',
        'as' => 'court'
    ]);

    Route::post('/caselist/documents/add', [
        'uses' => 'CaseListController@addCaseDocument',
        'as' => 'Add Case Document'
    ]);
    
    Route::post('/caselist/edit/{id}', [
        'uses' => 'CaseListController@update',
        'as' => 'Update Case'
    ]);
    
    Route::get('/caseinfo/petition/show', [
        'uses' => 'CaseListController@getCasePetition',
        'as' => 'petition'
    ]);
    
    Route::post('/caseinfo/petition/create', [
        'uses' => 'CaseListController@saveCasePetition',
        'as' => 'savepetition'
    ]);
    
    Route::put('/caseinfo/petition/update', [
        'uses' => 'CaseListController@updateCasePetition',
        'as' => 'updatepetition'
    ]);
    
    Route::delete('/caseinfo/petition/{id}', [
        'uses' => 'CaseListController@deleteCasePetition',
        'as' => 'delete_petition'
    ]);
    
    
    Route::get('/caseinfo/connected/show', [
        'uses' => 'CaseListController@getConnectedCase',
        'as' => 'connected_case'
    ]);
    Route::post('/caseinfo/connected/create', [
        'uses' => 'CaseListController@saveConnectedCase',
        'as' => 'save_connected_case'
    ]);
    
    Route::put('/caseinfo/connected/update', [
        'uses' => 'CaseListController@updateConnectedCase',
        'as' => 'update_connected_case'
    ]);
    
    Route::delete('/caseinfo/connected/{id}', [
        'uses' => 'CaseListController@deleteConnectedCase',
        'as' => 'delete_petition'
    ]);
    
    Route::get('/caseinfo/activities/show', [
        'uses' => 'AuditController@getCaseActivities',
        'as' => 'activities'
    ]);
    
    Route::get('/caseinfo/hearings/show', [
        'uses' => 'HearingsController@getHearings',
        'as' => 'getHearings'
    ]);
    
    Route::delete('/caseinfo/hearings/{id}', [
        'uses' => 'HearingsController@deleteHearings',
        'as' => 'deleteHearings'
    ]);
    
    Route::get('/calendar/event/list', [
        'uses' => 'EventController@getEventsList',
        'as' => 'getEventsForCalendar'
    ]);
    
    Route::get('/calendar/hearings/list', [
        'uses' => 'HearingsController@getHearingsList',
        'as' => 'getHearingsForCalendar'
    ]);
    
    Route::get('/calendar/hearings/today', [
        'uses' => 'HearingsController@getTomorrowsHearingsList',
        'as' => 'getHearingsForCalendar'
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/profile/{slug}', [
        'uses' => 'ProfilesController@index',
        'as' => 'profile'
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

    Route::get('/get_auth_user_data', [
        'uses' => 'UsersController@getAuthUserData'
    ]);

    Route::get('/like/{id}', [
        'uses' => 'LikesController@like'
    ]);

    Route::get('/unlike/{id}', [
        'uses' => 'LikesController@unlike'
    ]);

    Route::get('/storage/{any}', [
	'as'=>'image', 
	'uses'=>'ImageController@getImage'
    ])->where('any', '.*');
});

// Login Routes...
    Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
    Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
    Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
    Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);

Route::any('{catchall}', function() {
  return view('layouts.app');
})->where('catchall', '.*');