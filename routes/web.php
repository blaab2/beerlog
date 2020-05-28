<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['auth']], function () {
	
	Route::resource('users', 'UserController');
	Route::post('users/{user}/swapAdminStatus','UserController@swapAdminStatus')->name('users.swapadmin');
	
	Route::post('/addbeer', 'BeerController@addBeer')->name('addbeer');
	Route::resource('users.beers', 'BeerController')->shallow();

	Route::resource('users.cashflow','CashflowController')->shallow();
	
	Route::resource('settings', 'SettingController');
});