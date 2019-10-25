<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('booking/{token}', 'Api\AuthController@index');


Route::resource('bookings', 'Api\BookingController');
Route::get('getClient/{clientid}', 'Api\BookingController@Getclient');
Route::get('getPaid', 'Api\BookingController@Getpaid');
Route::get('getUnpaid', 'Api\BookingController@Getunpaid');
Route::get('getCancelled', 'Api\BookingController@Getcancelled');


Route::resource('providers', 'Api\ProviderController');
Route::resource('services', 'Api\ServiceController');
Route::resource('time', 'Api\TimeController');
Route::resource('day', 'Api\DayController');
Route::resource('location', 'Api\LocationController');
Route::resource('specialdayrules', 'Api\SpecialDayController');
Route::resource('paymentstatus', 'Api\PaymentstatusController');
Route::resource('paymentprocessor', 'Api\PaymentprocessorController');