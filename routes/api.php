<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MidtransCallbackController;
use App\Http\Controllers\Api\PelangganController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('midtrans/notification', [MidtransCallbackController::class, 'handleNotificationMidtrans']);

// API untuk mengambil biaya beban dan tarif kwh pelanggan pada saat admin memilih pelanggan
Route::get('/pelanggan/{id}', [PelangganController::class, 'getBiayaBeban']);
