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

Route::get('/', 'FrontendController@userRegistration');

Route::get('/user-registration', 'FrontendController@userRegistration')->name('user.registration');

Route::post('/user-registration', 'FrontendController@userRegistrationSave')->name('user.registration.save');

Route::get('/user-login', 'FrontendController@userLogin')->name('user.login');

Route::post('/user-login', 'FrontendController@userLoginProcess')->name('user.login.process');

Route::post('/user-login-granttype', 'FrontendController@userLoginGrantType')->name('user.login.granttype');

Route::get('/user-account', 'FrontendController@userAccount')->name('user.account');

Route::get('/user-logout', 'FrontendController@userLogout')->name('user.logout');
