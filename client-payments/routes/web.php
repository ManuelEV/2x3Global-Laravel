<?php

use App\Jobs\DollarToCLP;
use App\Jobs\SendMail;
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

Route::get('/api/clients', 'ClientController@list');
Route::post('/api/clients', 'ClientController@store');


Route::get('/api/payments', 'PaymentController@list');
Route::post('/api/payments', 'PaymentController@store');

//To get the current price of dollar in CLP and send a random email with Mailtrap
Route::post('/api/payments', function(){
    $job = new DollarToCLP();
    dispatch($job);

    $send_mail = new SendMail();
    dispatch($send_mail);
});