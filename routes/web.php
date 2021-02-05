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

Route::get('/', function () { return view('top'); });
Route::get('/top', function () { return view('topimage'); });
Route::get('/welcome', function () { return view('welcome'); });
Route::get('/userRegist', 'UserRegistController@index');
Route::post('/userRegist', 'UserRegistController@show');
Route::post('/userRegistTemp', 'UserRegistController@store');
Route::get('/userTop', 'UserRegistController@top');
Route::get('/userSearchTop', 'UserRegistController@search');
Route::get('/userSearch', 'UserRegistController@searchResult');
Route::post('/userSearch', 'UserRegistController@searchResult');
Route::get('/userJobTop', 'UserRegistController@userJob');
Route::post('/userJob', 'UserRegistController@userJob');
Route::get('/userJobDetail', 'UserRegistController@userJobDetail');
Route::post('/entryJob', 'UserRegistController@entryJob');
Route::get('/prodDetail', 'UserRegistController@prodDetail');
Route::get('/userEdit', 'UserRegistController@edit');
Route::post('/userEdit', 'UserRegistController@edit');
Route::get('/usertoken', 'UserRegistController@update');
Route::get('/userPass', 'UserRegistController@password');
Route::post('/userPass', 'UserRegistController@passReset');
Route::get('/login', 'loginController@index');
Route::post('login', 'loginController@show');
Route::get('/comTop', 'ComRegistController@top');
Route::get('/comRegist', 'ComRegistController@index');
Route::post('/comRegist', 'ComRegistController@show');
Route::post('/comRegistTemp', 'ComRegistController@store');
Route::get('/comProd', 'ComRegistController@product');
Route::post('/comProd', 'ComRegistController@product');
Route::get('/newProd', 'ComRegistController@newProd');
Route::post('/newProd', 'ComRegistController@confirmProd');
Route::post('/newProdRegist', 'ComRegistController@registProd');
Route::get('/prodEdit', 'ComRegistController@prodEdit');
Route::get('/comEdit', 'ComRegistController@edit');
Route::get('/comtoken', 'ComRegistController@update');
Route::get('/comPass', 'ComRegistController@password');
Route::post('/comPass', 'ComRegistController@passReset');
Route::get('/jobSearch', 'ComRegistController@jobSearch');
Route::get('/newJob', 'ComRegistController@newJob');
Route::post('/newJob', 'ComRegistController@jobConfirm');
Route::get('/jobDetail', 'ComRegistController@jobDetail');
Route::get('/comUser', 'ComRegistController@userSearch');
Route::post('/comUser', 'ComRegistController@userSearch');
Route::get('/comUserDetail', 'ComRegistController@userDetail');
Route::get('/comOffer', 'ComRegistController@userOffer');
Route::get('/admin', 'SiteController@index');
Route::post('admin', 'SiteController@show');
Route::get('/admintop', 'SiteController@create');
Route::post('/admintop', 'SiteController@update');
Route::get('/siteget', 'SiteController@store');
Route::get('/contact', 'SiteController@contact');
Route::post('/contact', 'SiteController@contactmail');
Route::get('/privacypolicy', 'SiteController@privacypolicy');
Route::get('/rules', 'SiteController@rules');
Route::get('/password', 'SiteController@password');
Route::post('/password', 'SiteController@passwordmail');
Route::get('/logout', 'SiteController@logout');
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
\URL::forceScheme('https');
