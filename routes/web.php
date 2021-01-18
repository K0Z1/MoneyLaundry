<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

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
    return redirect('login');
});

Route::get('login', [
	'uses' => 'App\Http\Controllers\AuthController@login',
	'as' => 'login'
]);

Route::post('login', [
	'uses' => 'App\Http\Controllers\AuthController@postLogin',
	'as' => 'post.login'
]);

Route::get('logout', [
	'uses' => 'App\Http\Controllers\AuthController@logout',
	'as' => 'logout'
]);

Route::group(['middleware' => ['auth','checkRole:admin']], function (){
	// Dashboard Admin
	Route::get('admin/dashboard', [
		'uses' => 'App\Http\Controllers\DashboardController@admin',
		'as' => 'admin.dashboard'
	]);

	// Outlet
	Route::resource('outlet', OutletController::class);
	Route::get('json/outlet', [OutletController::class, 'json'])->name('json.outlet');
	Route::patch('outlet/{id}/update', [OutletController::class, 'update']);

	// Paket/Cucian
	Route::resource('paket', PaketController::class);
	Route::get('json/paket/outlet', [PaketController::class, 'json'])->name('json.paket.outlet'); // Json Outlet Yang Sudah Di Modif
	Route::get('json/paket/{idOutlet}', [PaketController::class, 'jsonFilter'])->name('json.paket'); // Json Filter Paket

	// Pengguna
	Route::resource('pengguna', PenggunaController::class);
	Route::get('json/pengguna', [PenggunaController::class, 'json'])->name('json.pengguna');
	Route::get('pengguna/{id}/profile', [PenggunaController::class, 'profile']);

	// Update Password Pengguna
	Route::post('/ganti/kata-sandi/{id}/pengguna', [
		'uses' => 'App\Http\Controllers\PenggunaController@updatePw',
		'as' => 'updatePw.pengguna'
	]);

	// Coba Dynamic
	Route::get('/coba/dynamic', [TransaksiController::class, 'coba'])->name('coba');	
});

Route::group(['middleware' => ['auth','checkRole:admin,kasir']], function (){
	// Dashboard Kasir
	Route::get('kasir/dashboard', [
		'uses' => 'App\Http\Controllers\DashboardController@kasir',
		'as' => 'kasir.dashboard'
	]);
	
	// Pelanggan
	Route::resource('pelanggan', PelangganController::class);
	Route::get('json/pelanggan', [PelangganController::class, 'json'])->name('json.pelanggan');

	// Transaksi
	Route::resource('transaksi', TransaksiController::class);	
	Route::get('json/transaksi', [TransaksiController::class, 'json'])->name('json.transaksi');
	Route::get('/json/{id}/cari-pelanggan', [TransaksiController::class, 'cariMember']);
	Route::get('tambah-paket/{idTransaksi}/transaksi/{idOutlet}', [TransaksiController::class, 'tPaket'])->name('tPaket');
	Route::get('/json/cari-paket/{id}/detail-transaksi', [TransaksiController::class, 'detailTransaksi'])->name('json.dTransaksi');
	Route::get('/json/{id}/status', [TransaksiController::class, 'jsonStatus']);
	Route::patch('/status/{id}/update',[TransaksiController::class, 'statusUpdate']);
	Route::post('tambah-paket/{id}/detail-transaksi', [TransaksiController::class,'tPaketStore'])->name('tPaketStore');
	Route::delete('dPaket/{id}', [TransaksiController::class, 'destroyPaket'])->name('dPaket');
	Route::post('update/transaksi/{id}/detail-transaksi', [TransaksiController::class, 'updateTransaksi'])->name('uTransaksi');
	Route::get('/detail-transaksi/{kodeinvoice}/cucian', [TransaksiController::class, 'detailView']);
	
	// Json Dynamic Dropdown
	Route::get('json/cari-paket/{id}', [TransaksiController::class, 'paket']);	
	Route::get('json/cari-jenis/{id}/{namaPaket}', [TransaksiController::class, 'jenis']);	
	Route::get('json/cari-harga/{id}', [TransaksiController::class,'harga']);

	// Laporan
	Route::get('laporan', [LaporanController::class,'index'])->name('laporan.index');
});

Route::group(['middleware' => ['auth','checkRole:admin,kasir,owner']], function (){
	// Dashboard Owner
	Route::get('owner/dashboard', [
		'uses' => 'App\Http\Controllers\DashboardController@owner',
		'as' => 'owner.dashboard'
	]);

	// Outlet
	Route::get('owner/outelt', [OutletController::class, 'owner'])->name('owner.outelt');
	Route::get('json/outlet/owner', [OutletController::class,'jsonOwner'])->name('json.outlet.owner');

	// Laporan
	Route::get('owner/laporan', [LaporanController::class, 'laporanOwner'])->name('laporan.owner');
	Route::post('laporan/cari', [LaporanController::class, 'cari'])->name('laporan.cari');

	// Export
	Route::get('laporan/export-excel', [LaporanController::class, 'xportExcel'])->name('export.excel');
	Route::get('laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('export.pdf');
	
	// Ganti Password
	Route::get('/ganti/{user}/kata-sandi', [
		'uses' => 'App\Http\Controllers\AuthController@gantiKs',
		'as' => 'ganti.ks'
	]);

	Route::post('/ganti/{user}/kata-sandi', [
		'uses' => 'App\Http\Controllers\AuthController@updatePw',
		'as' => 'pengguna.gantiPw'
	]);
});