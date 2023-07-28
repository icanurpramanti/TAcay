<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingTokoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransaksiController;


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

///routes admin 
Route::middleware(['auth', 'CheckLevel:admin'])->group(function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/bank', BankController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/setting_toko', SettingTokoController::class);
    Route::get('/home', [HomeController::class, 'index']);
    Route::resource('/register', RegisterController::class);

    ///pembelian
    Route::get('/pembelian/{kode_pembelian}/create', [PembelianController::class, 'create'])->name('admin.dashboard.pembelian.create');
    Route::resource('/pembelian', PembelianController::class)
        ->except('create');
    Route::get('/pembelian/data', [PembelianController::class, 'data']);



    //pembelian detail
    Route::get('/pembelian_detail/{kode_supplier}', [PembelianDetailController::class, 'index']);
    Route::post('/pembelian_detail', [PembelianDetailController::class, 'store'])->name('pembelian_detail.store');
    Route::delete('/pembelian_detail/{id}', [PembelianDetailController::class, 'destroy'])->name('pembelian_detail.destroy');
    Route::put('/pembelian_detail/{id}', [PembelianDetailController::class, 'update'])->name('pembelian_detail.update');
    Route::get('/pembelian_detail/pilihProduk/{kode_produk}', [PembelianDetailController::class, 'pilihProduk'])->name('pembelian_detail.pilihProduk');
    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('admin.dashboard.pembelian_detail.load_form');
    // Route::resource('/pembelian_detail', PembelianDetailController::class)
    // ->except('create', 'show', 'edit');


    //penjualan
    Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
    Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');


    Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
    Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
    Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
    Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
    Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

    //penjualandetail
    Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)
        ->except('show');

        
    //setting    
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.dashboard.setting.index');
    Route::get('/setting/first', [SettingController::class, 'show'])->name('admin.dashboard.setting.show');
    Route::post('/setting', [SettingController::class, 'update'])->name('admin.dashboard.setting.update');
});

///route detail
Route::get('/produk-detail/{id}', [ProdukController::class, 'detail'])->name("produk-detail");
Route::get('/supplier-detail/{id}', [SupplierController::class, 'detail'])->name("supplier-detail");
Route::get('/kategori-detail/{id}', [KategoriController::class, 'detail'])->name("kategori-detail");
Route::get('/satuan-detail/{id}', [SatuanController::class, 'detail'])->name("satuan-detail");
Route::get('/setting_toko-detail/{id}', [SettingTokoController::class, 'detail'])->name("setting_toko-detail");
Route::get('/user-detail/{id}', [UserController::class, 'detail'])->name("user-detail");

//routes kasir 
Route::middleware(['auth', 'CheckLevel:kasir'])->group(function () {
    Route::get('/dashboardkasir', [HomeController::class, 'indexkasir']);
    
});




//routes untuk pencarian
// Route::get('/search', [UserController::class, 'search'])->name('search');
// Route::get('/search_kategori', [KategoriController::class, 'searchkategori'])->name('searchkategori');
// Route::get('/search_satuan', [SatuanController::class, 'searchsatuan'])->name('searchsatuan');
// Route::get('/search_supplier', [SupplierController::class, 'searchsupplier'])->name('searchsupplier');
// Route::get('/search_produk', [ProdukController::class, 'searchproduk'])->name('searchproduk');
// Route::get('/search_bank', [BankController::class, 'searchbank'])->name('searchbank');
// Route::get('/search_pembelian', [PembelianController::class, 'searchpembelian'])->name('searchpembelian');




///routes login,register,logout
Route::get ('/login', [LoginController::class,'login'])->name('login')->middleware('guest');
// Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

// Route::get('register',[RegisterController::class,'register'])->name('register');
// Route::post('register/action',[RegisterController::class, 'actionregister'])->name('actionregister');
