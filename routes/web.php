<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');

// Admins


Route::prefix('admin')->group(function() {

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    Route::get('/logout', 'Auth\AdminLoginController@logoutAdmin')->name('admin.logout');


    //CRUD on admin area
    Route::resource('/modules', 'ModuleController');
    Route::post('/modules/bulk_remove', 'ModuleController@bulk_remove')->name('modules.bulk_remove');


    Route::resource('/courses', 'CourseController');
    Route::post('/courses/bulk_remove', 'CourseController@bulk_remove')->name('courses.bulk_remove');

    Route::resource('/certificates', 'CertificateController');
    Route::post('/certificates/bulk_remove', 'CertificateController@bulk_remove')->name('certificates.bulk_remove');

    Route::resource('/settings', 'SettingController');
    Route::post('/settings/bulk_remove', 'SettingController@bulk_remove')->name('settings.bulk_remove');
    
    Route::resource('/lectures', 'LectureController');
    Route::post('/lectures/bulk_remove', 'LectureController@bulk_remove')->name('lectures.bulk_remove');

    Route::resource('/days', 'DayController');
    Route::post('/days/bulk_remove', 'DayController@bulk_remove')->name('days.bulk_remove');


    // connections
    Route::get('/connections', 'ConnectionController@index')->name('connections.index');
    Route::post('/connections/store_connections', 'ConnectionController@storeConnections')->name('connections.store');

});

