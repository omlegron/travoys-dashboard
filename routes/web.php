<?php

use App\Imports\KelolaData\Inflow\InflowImport;
use App\Imports\KelolaData\Outflow\OutFlowImport;
use App\Imports\KelolaData\Uyd\UydImport;
use App\Imports\KelolaData\UydPecahan\UydPecahanImport;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;

Route::middleware('auth')->group(function() {
	Route::get('/', function () {
	    return redirect()->route('dashboard');
	    // return view('welcome');
	});
	Route::get('/register', function () {
	    return redirect()->route('dashboard');
	    // return view('welcome');
	});

	
	Route::get('/dashboard', 'Dashboard\DashboardController@index')->name('dashboard');	

	Route::name('master.')->prefix('master')->namespace('Master')->group(function() {

		Route::get('/event/add-event-users/{id}', 'EventController@createUsers')->name('event.createUsers');
		Route::delete('/event/delete-event-users/{id}', 'EventController@destroyUsers')->name('event.destroyUsers');
		Route::post('/event/store-users', 'EventController@storeUsers')->name('event.storeUsers');
		Route::post('/event/post-scan', 'EventController@postScan')->name('event.postScan');
		Route::post('/event/gridusers', 'EventController@gridUsers')->name('event.gridusers');


		// EVENT
		Route::get('/event/users/{id}', 'EventController@users')->name('event.users');
		Route::get('/event/scan/{id}', 'EventController@scan')->name('event.scan');
		Route::post('/event/grid', 'EventController@grid')->name('event.grid');
		Route::resource('/event', 'EventController');
		
		
	});

	// Route::name('master.')->prefix('master')->namespace('Master')->group(function() {
	// 	// EVENT USERS
	// 	Route::post('/event-users/grid', 'EventUsersController@grid')->name('event-users.grid');
	// 	Route::get('/event-users/{id}', 'EventUsersController@index')->name('event-users.index');
		
	// });


	Route::name('setting.')->prefix('setting')->namespace('Setting')->group( function() {
		Route::get('/', function(){
			return redirect()->route('setting.users.index');
		});

		Route::post('users/grid', 'UserController@grid')->name('users.grid');
		Route::resource('users', 'UserController');

		Route::post('roles/grid', 'RoleController@grid')->name('roles.grid');
		Route::resource('roles', 'RoleController');
	});

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
