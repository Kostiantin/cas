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

    Route::resource('/courses', 'CourseController');

    Route::resource('/certificates', 'CertificateController');

});

