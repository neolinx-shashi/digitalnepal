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

Route::resource('/vendor', 'Back\VendorController');
Route::get('/deleteVendor/{id}', 'Back\VendorController@destroy');
Route::get('/generate-password', 'Back\VendorController@generatePassword');
Route::get('/vendor-type/{type}', 'Back\VendorController@list');

Route::resource('/channel', 'Back\ChannelController');
Route::get('/deleteChannel/{id}', 'Back\ChannelController@destroy');

Route::resource('/package', 'Back\PackageController');
Route::get('/deletePackage/{id}', 'Back\PackageController@destroy');

Route::get('/packagedetail/{id}', 'Back\PackageChannelController@index');
Route::post('/packagedetail/{id}', 'Back\PackageChannelController@store');

Route::resource('/stb', 'Back\StbController');
Route::get('/deleteStb/{id}', 'Back\StbController@destroy');

Route::resource('/stb-record', 'Back\StbRecordController');
Route::get('/deleteStbRecord/{id}', 'Back\StbRecordController@destroy');

Route::resource('/purchase', 'Back\PurchaseController');
Route::get('/deletePurchase/{id}', 'Back\PurchaseController@destroy');

Route::resource('/deposit', 'Back\DepositController');

Route::resource('/wallet', 'Back\WalletController');
Route::get('/check-deposit/{id}', 'Back\WalletController@checkDeposit');

Route::resource('/commission', 'Back\CommissionController');
