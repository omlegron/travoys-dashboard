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
		Route::post('/event/grid', 'EventController@grid')->name('event.grid');
		Route::resource('/event', 'EventController');
	});


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
Route::get('scanqr','QRScanController@index');
