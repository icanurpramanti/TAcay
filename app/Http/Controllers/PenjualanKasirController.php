<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\PenjualanDetail;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use PDF;

class PenjualanKasirController extends Controller
{
    public function index()
    {
        return view('kasir.dashboard.penjualan.index');
    }

    public function data()
    {
        $penjualans = Penjualan::orderBy('id_penjualan', 'desc')->get();

        return datatables()
            ->of($penjualans)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualans) {
                return format_uang($penjualans->total_item);
            })
            ->addColumn('total_harga', function ($penjualans) {
                return 'Rp. ' . format_uang($penjualans->total_harga);
            })
            ->addColumn('bayar', function ($penjualans) {
                return 'Rp. ' . format_uang($penjualans->bayar);
            })
            ->addColumn('tanggal', function ($penjualans) {
                return tanggal_indonesia($penjualans->created_at, false);
            })
            ->editColumn('diskon', function ($penjualans) {
                return $penjualans->diskon . '%';
            })
            ->editColumn('user', function ($penjualans) {
                return $penjualans->user->level ?? '';
            })
            ->addColumn('aksi', function ($penjualans) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`' . route('penjualankasir.show', $penjualans->id_penjualan) . '`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $penjualans = new Penjualan();
        $penjualans->total_item = 0;
        $penjualans->total_harga = 0;
        $penjualans->diskon = 0;
        $penjualans->bayar = 0;
        $penjualans->diterima = 0;
        $penjualans->id_user = auth()->id();
        $penjualans->save();

        session(['id_penjualan' => $penjualans->id_penjualan]);
        return redirect()->route('transaksikasir.index');
    }
    
    public function store(Request $request)
    {

        $penjualans = Penjualan::findOrFail($request->id_penjualan);
        //  dd($penjualans);
        // $penjualan->id_penjualan = $request->id_penjualan;
        $penjualans->total_item = $request->total_item;
        $penjualans->total_harga = $request->total;
        $penjualans->diskon = $request->diskon;
        $penjualans->bayar = $request->bayar;
        $penjualans->diterima = $request->diterima;
        $penjualans->update();
        $detail = PenjualanDetail::where('id_penjualan', $penjualans->id_penjualan)->get();
        $kodeproduk = [];

        foreach ($detail as $item) {
            $kodeproduk[] = $item->kode_produk;
            $item->update();

            // Ambil produk berdasarkan kode_produk
            $produk = Produk::where('kode_produk', $item->kode_produk)->first();

            $updateStock = $produk->stok - $item->jumlah;
            $produk->update([
                'stok' => $updateStock
            ]);
        }

        return redirect()->route('transaksikasir.selesai');
    }

    public function show($id)
    {
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">' . $detail->produk->kode_produk . '</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. ' . format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. ' . format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function selesai()
    {
        return view('kasir.dashboard.penjualan.selesai');
    }

    public function notaKecil()
    {

        $penjualans = Penjualan::find(session('id_penjualan'));
        if (!$penjualans) {
            abort(404);
        }
        $detail = PenjualanDetail::with('produk')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        return view('kasir.dashboard.penjualan.nota_kecil', compact( 'penjualans', 'detail'));
    }
   

}
