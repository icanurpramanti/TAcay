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
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/bank', BankController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/setting_toko', SettingTokoController::class);
    Route::resource('/register', RegisterController::class);

    ///pembelian
    Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('admin.dashboard.pembelian.create');
    Route::resource('/pembelian', PembelianController::class)
        ->except('create');
    Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('admin.dashboard.pembelian.data');

    //pembelian detail
    Route::resource('/pembelian_detail', PembelianDetailController::class)
        ->except('create', 'show', 'edit');
    Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('admin.dashboard.pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('admin.dashboard.pembelian_detail.load_form');


    //penjualan
    Route::get('/penjualan/baru', [PenjualanController::class, 'create'])->name('penjualan.baru');
    Route::resource('/penjualan', PenjualanDetailController::class)
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

///routes kasir 
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/transaksi', TransaksiController::class);
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
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

// Route::get('register',[RegisterController::class,'register'])->name('register');
// Route::post('register/action',[RegisterController::class, 'actionregister'])->name('actionregister');
