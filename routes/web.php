<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;


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
    return redirect()->route('login');
});

///routes admin 
Route::middleware(['auth', 'CheckLevel:admin'])->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/user', UserController::class);
    Route::get('/home', [HomeController::class, 'index']);


    ///pembelian
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
    Route::resource('/pembelian', PembelianController::class)
        ->except('create');
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');

    //pembelian detail
    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
    Route::resource('/pembelian_detail', PembelianDetailController::class)
        ->except('create', 'show', 'edit');

    //penjualan
    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');

    //penjualandetail
    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
        ->except('show');

     //laporan
     Route::get('/laporan',[LaporanController::class,'index'])->name('laporan.index');
     Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
     Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');


    
     ///route detail
     Route::get('/produk-detail/{id}', [ProdukController::class, 'detail'])->name("produk-detail");
     Route::get('/supplier-detail/{id}', [SupplierController::class, 'detail'])->name("supplier-detail");
     Route::get('/kategori-detail/{id}', [KategoriController::class, 'detail'])->name("kategori-detail");
     Route::get('/satuan-detail/{id}', [SatuanController::class, 'detail'])->name("satuan-detail");
     Route::get('/setting_toko-detail/{id}', [SettingTokoController::class, 'detail'])->name("setting_toko-detail");
     Route::get('/user-detail/{id}', [UserController::class, 'detail'])->name("user-detail");
 
});

   

//routes kasir 
Route::middleware(['auth', 'CheckLevel:kasir'])->group(function () {
    Route::get('/homee', [HomeController::class, 'indexkasir']);

    //penjualan
    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualaan', [PenjualanController::class, 'indexkasir'])->name('penjualaan.index');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

    Route::get('/transaksi/baruu', [PenjualanController::class, 'createKasir']);
    Route::post('/transaksi/simpaan', [PenjualanController::class, 'storeKasir']);
    Route::get('/transaksi/selesaii', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/selesaii', [PenjualanController::class, 'selesaiKasir'])->name('transaksi.selesaii');
    Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');

    //penjualandetail
    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
        ->except('show');
    Route::get('/transaksii', [PenjualanDetailController::class,'indexKasir']);

});

///routes login,logout
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

