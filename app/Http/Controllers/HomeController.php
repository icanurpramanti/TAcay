<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
{
    $kategoris = Kategori::count();
    $produks = Produk::count();
    $suppliers = Supplier::count();
    $users = User::count();
   
    $tanggal_awal = date('Y-m-01');
    $tanggal_akhir = date('Y-m-d');

    $data_tanggal = array();
    $data_pendapatan = array();

    while (strtotime($tanggal_awal) <= strtotime($tanggal_akhir)) {
        $data_tanggal[] = (int) substr($tanggal_awal, 8, 2);

        $total_penjualan = Penjualan::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
        $total_pembelian = Pembelian::where('created_at', 'LIKE', "%$tanggal_awal%")->sum('bayar');
        $pendapatan = $total_penjualan - $total_pembelian;
        $data_pendapatan[] = $pendapatan;

        $tanggal_awal = date('Y-m-d', strtotime("+1 day", strtotime($tanggal_awal)));
    }

    return view('admin.dashboard.home', [
        'kategoris' => $kategoris,
        'produks' => $produks,
        'suppliers' => $suppliers,
        'users' => $users,
        'data_tanggal' => $data_tanggal,
        'data_pendapatan' => $data_pendapatan,
    ]);
}


    public function indexkasir()
    {
        return view('kasir.dashboard.home');
    }

    
}
