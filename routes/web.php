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

SecureRoute::get('favicon/{state}', 'FaviconController@display');

SecureRoute::get('login', 'UserController@login');
SecureRoute::get('login/{state}', 'UserController@login');
SecureRoute::post('login', 'UserController@login');
SecureRoute::get('register', 'UserController@register');
SecureRoute::post('register', 'UserController@register');

SecureRoute::group('admin', function() {

    SecureRoute::get('', 'AdminHomeController@index', 1, 1);
        
	SecureRoute::get('/settings/system', 'AdminSettingsController@system', 1, 2);
	SecureRoute::post('/settings/system', 'AdminSettingsController@system', 1, 2);

	SecureRoute::get('/settings/menumanager', 'AdminMenuController@index', 1, 3);
	SecureRoute::post('/settings/menumanager/add', 'AdminMenuController@addButton', 1, 4);
	SecureRoute::post('/settings/menumanager/saveorder', 'AdminMenuController@saveOrder', 1, 5);

	SecureRoute::get('/settings/languages', 'AdminLanguagesController@index', 1, 6);
	SecureRoute::get('/settings/languages/add', 'AdminLanguagesController@add', 1, 7);
});

Route::get('/test', function(Request $request) {

	#
	echo bin2hex(openssl_random_pseudo_bytes(15));
});