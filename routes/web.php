<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SearchingController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard/users', [DashboardController::class, 'pembayaranView'])->name('dashboard.users')->middleware('auth');

Route::get('/dashboard/pelanggan', [DashboardController::class, 'pelangganView'])->name('dashboard.pelanggan')->middleware('auth');
Route::post('/dashboard/pelanggan/store', [DashboardController::class, 'createDataPelanggan'])->name('dashboard.pelanggan.create')->middleware('auth');
Route::put('/dashboard/pelanggan/update/{id_pelanggan}', [DashboardController::class, 'updateDataPelanggan'])->name('dashboard.pelanggan.update')->middleware('auth');
Route::delete('/dashboard/pelanggan/delete/{id_pelanggan}', [DashboardController::class, 'deletePelanggan'])->name('dashboard.pelanggan.delete')->middleware('auth');

Route::get('/login', [LoginController::class, 'login'])->name('auth.login')->middleware('guest');
Route::post('/login-post', [LoginController::class, 'loginPost'])->name('auth.post.login');


Route::get('/', [HomeController::class, 'pelangganView'])->name('pelanggan');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout')->middleware('auth');

Route::post('/proses/payment/{id_pemakaian}', [PembayaranController::class, 'prosesPayment'])->name('proses.payment');

Route::get('/print-pembayaran', [PembayaranController::class, 'printPembayaran'])->name('print.pembayaran');

Route::get('/petugas', [SuperAdminController::class, 'petugasView'])->name('dashboard.petugas');
Route::post('/petugas/post', [SuperAdminController::class, 'create'])->name('dashboard.petugas.create');
Route::put('/petugas/{user}', [SuperAdminController::class, 'update'])->name('dashboard.petugas.update');
Route::delete('/petugas-delete/{user}', [SuperAdminController::class, 'delete'])->name('dashboard.petugas.delete');

// Dashboard Pemakaian
Route::get('/pemakaian', [DashboardController::class, 'pemakaianView'])->name('dashboard.pemakaian');
Route::post('/pemakaian/post', [DashboardController::class, 'createPemakaian'])->name('dashboard.pemakaian.create');
Route::put('/pemakaian/{id_pemakaian}', [DashboardController::class, 'updatePemakaian'])->name('dashboard.pemakaian.update');
Route::delete('/pemakaian-delete/{id_pemakaian}', [DashboardController::class, 'deletePemakaian'])->name('dashboard.pemakaian.delete');

// Dashboard Kapasitas
Route::get('/kapasitas', [DashboardController::class, 'kapasitasView'])->name('dashboard.kapasitas');
Route::post('/kapasitas/post', [DashboardController::class, 'createKapasitas'])->name('dashboard.kapasitas.create');
Route::put('/kapasitas/{kapasitas}', [DashboardController::class, 'updateKapasitas'])->name('dashboard.kapasitas.update');
Route::delete('/kapasitas-delete/{kapasitas}', [DashboardController::class, 'deleteKapasitas'])->name('dashboard.kapasitas.delete');

// Dashboard Jenis Pelanggan
Route::get('/jenis-pelanggan', [DashboardController::class, 'jenisPelangganView'])->name('dashboard.jenis.pelanggan');
Route::post('/jenis-pelanggan/post', [DashboardController::class, 'createJenisPelanggan'])->name('dashboard.jenis-pelanggan.create');
Route::put('/jenis-pelanggan/{id_jenis_pelanggan}', [DashboardController::class, 'updateJenisPelanggan'])->name('dashboard.jenis-pelanggan.update');
Route::delete('/jenis-pelanggan-delete/{data}', [DashboardController::class, 'deleteJenisPelanggan'])->name('dashboard.jenis-pelanggan.delete');
