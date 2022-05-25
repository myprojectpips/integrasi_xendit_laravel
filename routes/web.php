<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\ewalletController;
use App\Http\Controllers\vaController;
use App\Http\Controllers\qrCodeController;

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

Route::controller(dashboardController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::controller(ewalletController::class)->group(function () {
    Route::get('/ewallet', 'index')->name('index.ewallet');
    Route::get('/balance', 'balance')->name('ewallet.balance');

    Route::get('/ewallet/payment-channel', 'paymentChannel')->name('ewallet.paymentChannel');
    Route::post('/ewallet/create-charge-ewallet', 'ewalletCharge')->name('ewallet.createCharge');

    Route::post('/ewallet/callback', 'ewalletCallback')->name('ewallet.callback');
    Route::get('/ewallet/success', 'success')->name('ewallet.success');
    Route::get('/ewallet/failure', 'failure')->name('ewallet.failure');
    Route::get('/ewallet/cancel', 'cancel')->name('ewallet.cancel');

    Route::get('/ewallet/cek-status/{id}', 'getStatus')->name('ewallet.cekStatus');
});

Route::controller(vaController::class)->group(function () {
    Route::get('/va', 'index')->name('index.va');
    
    Route::post('/va/create-va', 'createVa')->name('va.createVa');
    Route::post('/va/callback', 'vaCallback')->name('va.callback');
    Route::get('/get-va-bank', 'getVA');
});

Route::controller(qrCodeController::class)->group(function () {
    Route::get('/qr-code', 'index')->name('index.qrCode');
    Route::post('/qr-code/create', 'createQR')->name('qrCode.create');
    Route::post('/qr-code/callback', 'QrCodeCallback')->name('qrCode.callback');
});