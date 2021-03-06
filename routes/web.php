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

Route::get('/', function () {return view('welcome');});

Route::get('/impressum', function () {return view('dsgvo');})->name('impressum');

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['verified']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('users', 'UserController');
    Route::post('users/{user}/swapAdminStatus', 'UserController@swapAdminStatus')->name('users.swapadmin');

    Route::post('/addbeer', 'BeerController@addBeer')->name('addbeer')->middleware('checkdebts');
    Route::resource('users.beers', 'BeerController')->shallow()->middleware('checkdebts');
    Route::get('beers', 'BeerController@index')->name('beers.index');

    Route::any('beers2', 'BeerController@index_ajax');

    Route::resource('users.cashflow', 'CashflowController')->shallow();

    Route::resource('settings', 'SettingController');

    Route::resource('beertype', 'BeerTypeController');
});
