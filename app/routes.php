<?php

// ID's accross all routes should be integers (parameter constraints on a global level)
// Regex \d+ means 1 or more digits
Route::pattern('id', '\d+');

// Filter every POST, PUT, DELETE request for the CSRF token (Pattern based Filter)
Route::when('*', 'csrf', ['post', 'put', 'delete']);

// Posts
Route::resource('posts', 'PostsController');

// Update 01/05/2015 Loi
Route::post('post/upload-post-image/{id}', 'PostsController@uploadPostImage');
Route::post('post/upload-content-image/{id}', 'PostsController@uploadContentImage');

Route::get('posts/tag/{name}',      'PostsController@postsForTag');
Route::get('posts/category/{name}', 'PostsController@postsForCategory');
Route::get('posts/user/{username}', 'PostsController@postsForUser');
Route::post('posts/search', ['as' => 'posts.search', 'uses' => 'PostsController@postsForSearch']); // Update 02/05/2015 Loi

// Comments
Route::resource('comments', 'CommentsController');


// Routes for Authenticated Users
Route::group(['before' => 'auth'], function()
{
    Route::get('users',             'UsersController@index');
    Route::get('users/{username}',  'UsersController@profile');
    Route::get('dashboard',         'AccountController@dashboard');
    Route::get('settings',          'AccountController@settings');
    Route::get('settings/edit',     'AccountController@settingsEdit');
    Route::post('settings/edit',    'AccountController@settingsSave');
    Route::get('password/change',   'AccountController@passwordChange');
    Route::post('password/change',  'AccountController@passwordSave');
    Route::post('delete-account',   'AccountController@deleteAccount');
    Route::get('logout',            'AuthController@logout');
});

// Routes for User Profile
Route::group(['before' => 'auth'], function()
{
    Route::get('profile',                'ProfileController@profile');
    Route::get('profile/edit',           'ProfileController@profileEdit');
    Route::post('profile/account-info',  'ProfileController@accountInfo');
    Route::post('profile/personal-info', 'ProfileController@personalInfo');
    Route::post('profile/avatar-upload', 'ProfileController@avatarUpload');
});


// Guest only Routes
Route::group(['before' => 'guest'], function()
{
    Route::get('login',              'AuthController@login');
    Route::post('login',             'AuthController@processLogin');
    Route::get('sign-up',            'AuthController@signUp');
    Route::post('sign-up',           'AuthController@processSignUp');
    Route::get('resend-activation',  'AuthController@resendActivation');
    Route::post('resend-activation', 'AuthController@resendActivationCode');
    Route::get('activate/{code}',    ['as'=>'activate', 'uses' => 'AuthController@activate']);
    Route::controller('password',    'RemindersController');
});


// Admin Routes
Route::group(['before' => 'auth|role:admin','prefix' => 'admin'], function()
{
    Route::group(['namespace' => 'Admin'], function()
    {
        Route::get('dashboard',        'AdminController@dashboard');
        Route::get('users',            'UsersController@users');
        Route::post('restore-user',    'UsersController@restoreUser');
        Route::post('ban-user',        'UsersController@banUser');
        Route::post('revoke-ban-user', 'UsersController@revokeBanUser');
        Route::post('assign-user-roles', 'UsersController@assignUserRoles');
        Route::get('posts',            'PostsController@posts');
        Route::get('api/posts',        'PostsController@postsApi');
        Route::resource('roles',       'RolesController', ['except'=> ['show', 'create']]);
        Route::resource('permissions', 'PermissionsController', ['except'=> ['show', 'create']]);
        // me
        Route::resource('comments',    'CommentsController');

    });
    Route::resource('tags',       'TagsController', ['except'=> ['show', 'create']]);
    Route::resource('categories', 'CategoriesController', ['except'=> ['show', 'create']]);

    // Update 01/05/2015 Loi
    Route::post('category/upload-category-image/{id}', 'CategoriesController@uploadCategoryImage');
    
});


// Public Routes
Route::get('feedback',  'PagesController@getFeedback');
Route::post('feedback', 'PagesController@saveFeedback');
Route::get('terms',     'PagesController@terms');
Route::get('privacy',   'PagesController@privacy');
Route::get('faqs',      'PagesController@faqs');
Route::get('about',     'PagesController@about');
Route::get('/',         'PagesController@home');


// Developer Routes
Route::get('hello', 'DevController@hello');

// Display all SQL executed in Eloquent if Debug mode is set to true
/*if (Config::get('app.debug'))
{
    Event::listen('illuminate.query', function($query)
    {
        var_dump($query);
    });
}*/


// Redirect to github to authenticate
Route::get('facebook', 'AccountController@github_redirect');
// Get back to redirect url
Route::get('account/facebook', 'AccountController@github');