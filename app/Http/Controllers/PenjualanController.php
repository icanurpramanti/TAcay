<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\PenjualanDetail;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use PDF;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.penjualan.index');
    }

    // public function data()
    // {
    //     $penjualans = Penjualan::orderBy('kode_penjualan', 'desc')->get();

    //     return datatables()
    //         ->of($penjualans)
    //         ->addIndexColumn()
    //         ->addColumn('total_item', function ($penjualans) {
    //             return format_uang($penjualans->total_item);
    //         })
    //         ->addColumn('total_harga', function ($penjualans) {
    //             return 'Rp. '. format_uang($penjualans->total_harga);
    //         })
    //         ->addColumn('bayar', function ($penjualans) {
    //             return 'Rp. '. format_uang($penjualans->bayar);
    //         })
    //         ->addColumn('tanggal', function ($penjualans) {
    //             return tanggal_indonesia($penjualans->created_at, false);
    //         })
    //         ->editColumn('diskon', function ($penjualans) {
    //             return $penjualans->diskon . '%';
    //         })
    //         ->editColumn('kasir', function ($penjualans) {
    //             return $penjualans->user->name ?? '';
    //         })
    //         ->addColumn('aksi', function ($penjualans) {
    //             return '
    //             <div class="btn-group">
    //                 <button onclick="showDetail(`'. route('penjualan.show', $penjualans->kode_penjualan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
    //                 <button onclick="deleteData(`'. route('penjualan.destroy', $penjualans->kode_penjualan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
    //             </div>
    //             ';
    //         })
    //         ->rawColumns(['aksi'])
    //         ->make(true);
    // }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        return redirect()->route('transaksi.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            // $penjualans->id_user = $request->id_user;
            $penjualans->update();
    
            $detail = PenjualanDetail::where('id_penjualan', $penjualans->id_penjualan)->get();
            foreach ($detail as $item) {
                $item->diskon = $request->diskon;
                $item->update();
    
                $produks = Produk::where('kode_produk', $item->kode_produk)->first();                $produks->stok -= $item->jumlah;
                $produks->update();
            
    
      return redirect()->route('transaksi.selesai');
        
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    //  public function show($id)
    // {
    //     $detail = PenjualanDetail::with('produks')->where('kode_penjualan', $id)->get();

    //     return datatables()
    //         ->of($detail)
    //         ->addIndexColumn()
    //         ->addColumn('kode_produk', function ($detail) {
    //             return '<span class="label label-success">'. $detail->produks->kode_produk .'</span>';
    //         })
    //         ->addColumn('nama_produk', function ($detail) {
    //             return $detail->produks->nama_produk;
    //         })
    //         ->addColumn('harga_jual', function ($detail) {
    //             return 'Rp. '. format_uang($detail->harga_jual);
    //         })
    //         ->addColumn('jumlah', function ($detail) {
    //             return format_uang($detail->jumlah);
    //         })
    //         ->addColumn('subtotal', function ($detail) {
    //             return 'Rp. '. format_uang($detail->subtotal);
    //         })
    //         ->rawColumns(['kode_produk'])
    //         ->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $penjualans = Penjualan::find($id);
    //     $detail    = PenjualanDetail::where('kode_penjualan', $penjualans->kode_penjualan)->get();
    //     foreach ($detail as $item) {
    //         $produks = Produk::find($item->id_produk);
    //         if ( $produks) {
    //              $produks->stok += $item->jumlah;
    //              $produks->update();
    //         }

    //         $item->delete();
    //     }

    //     $penjualans->delete();

    //     return response(null, 204);
    // }

    public function selesai()
    {
        // $settings = Setting::first();

        return view('penjualan.selesai');
    }

    // public function notaKecil()
    // {
    //     $settings = Setting::first();
    //     $penjualans = Penjualan::find(session('kode_penjualan'));
    //     if (! $penjualans) {
    //         abort(404);
    //     }
    //     $detail = PenjualanDetail::with('produks')
    //         ->where('kode_penjualan', session('kode_penjualan'))
    //         ->get();
        
    //     return view('penjualan.nota_kecil', compact('settings', 'penjualans', 'detail'));
    // }

    // public function notaBesar()
    // {
    //     $settings = Setting::first();
    //     $penjualans = Penjualan::find(session('kode_penjualan'));
    //     if (! $penjualans) {
    //         abort(404);
    //     }
    //     $detail = PenjualanDetail::with('produk')
    //         ->where('kode_penjualan', session('kode_penjualan'))
    //         ->get();

    //     $pdf = PDF::loadView('penjualan.nota_besar', compact('settings', 'penjualans', 'detail'));
    //     $pdf->setPaper(0,0,609,440, 'potrait');
    //     return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    // }
}
