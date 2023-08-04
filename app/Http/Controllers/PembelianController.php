<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy('nama_supplier')->get();

        return view('admin.dashboard.pembelian.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $pembelians = new Pembelian();
        $pembelians->kode_supplier = $id;
        $pembelians->total_item  = 0;
        $pembelians->total_harga = 0;
        $pembelians->diskon      = 0;
        $pembelians->bayar       = 0;
        $pembelians->save();

        session(['id_pembelian' => $pembelians->id_pembelian]);
        session(['kode_supplier' => $pembelians->kode_supplier]);

        return redirect()->route('pembelian_detail.index');
    }
    public function data()
    {
        $pembelians = Pembelian::orderBy('id_pembelian', 'desc')->get();

        return datatables()
            ->of($pembelians)
            ->addIndexColumn()
            ->addColumn('total_item', function ($pembelians) {
                return format_uang($pembelians->total_item);
            })
            ->addColumn('total_harga', function ($pembelians) {
                return 'Rp. '. format_uang($pembelians->total_harga);
            })
            ->addColumn('bayar', function ($pembelians) {
                return 'Rp. '. format_uang($pembelians->bayar);
            })
            ->addColumn('tanggal', function ($pembelians) {
                return tanggal_indonesia($pembelians->created_at, false);
            })
            ->addColumn('supplier', function ($pembelians) {
                return $pembelians->supplier->nama_supplier;
            })
            ->editColumn('diskon', function ($pembelians) {
                return $pembelians->diskon . '%';
            })
            ->addColumn('aksi', function ($pembelians) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('pembelian.show', $pembelians->id_pembelian) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelians = Pembelian::findOrFail($request->id_pembelian);
        $pembelians->total_item = $request->total_item;
        $pembelians->total_harga = $request->total;
        $pembelians->diskon = $request->diskon;
        $pembelians->bayar = $request->bayar;
        $pembelians->update();

        $detail = PembelianDetail::where('id_pembelian', $pembelians->id_pembelian)->get();
        $kodeproduk = [];

        foreach ($detail as $item) {
            $kodeproduk[] = $item->kode_produk;
            $item->update();

            // Ambil produk berdasarkan kode_produk
            $produk = Produk::where('kode_produk', $item->kode_produk)->first();

            $updateStock = $produk->stok + $item->jumlah;
            $produk->update([
                'stok' => $updateStock
            ]);
        }



        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = PembelianDetail::with('produk')->where('id_pembelian', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk->nama_produk;
            })
            ->addColumn('harga_beli', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_beli);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembelian  $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
