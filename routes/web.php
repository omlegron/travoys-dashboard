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

		// EVENT
		Route::post('/event/gridusers', 'EventController@gridUsers')->name('event.gridusers');
		Route::get('/event/users/{id}', 'EventController@users')->name('event.users');
		Route::get('/event/scan', 'EventController@scan')->name('event.scan');
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
