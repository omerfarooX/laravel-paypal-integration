<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Here we should be able to see a button to send the user to paypal
Route::get('payment', 'PaypalController@payThroughPaypal');

// This is where paypal will send the payment notification
Route::post('ipn-resolver', 'PaypalController@resolveIpn');

// This is where the user will be redirected after successful transaction (return url)
Route::post('payment-sucessfull', 'PaypalController@paymentSuccess');

// This is where the user will be redirected when the transaction has been cancelled in the middle
Route::post('payment-cancel', 'PaypalController@paymentCancel');