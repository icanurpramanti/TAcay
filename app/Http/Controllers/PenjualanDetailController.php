<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\PenjualanDetail;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $id_penjualan = session('id_penjualan');
        $produks = Produk::orderBy('nama_produk')->get();
        
    
        // $diskon = Setting::first()->diskon ?? 0;

        return view('admin.dashboard.penjualan_detail.index', compact('id_penjualan', 'produks'));

     }
   
     public function data($id)
     {
         $detail = PenjualanDetail::with('produk')
             ->where('id_penjualan', $id)
             ->get();
 
         $data = array();
         $total = 0;
         $total_item = 0;
 
         foreach ($detail as $item) {
             $row = array();
             $row['kode_produk'] = '<span class="label label-success">'. $item->produk['kode_produk'] .'</span';
             $row['nama_produk'] = $item->produk['nama_produk'];
             $row['harga_jual']  = 'Rp. '. format_uang($item->harga_jual);
             $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_penjualan_detail .'" value="'. $item->jumlah .'">';
             $row['diskon']      = $item->diskon . '%';
             $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
             $row['aksi']        = '<div class="btn-group">
                                     <button onclick="deleteData(`'. route('transaksi.destroy', $item->id_penjualan_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                 </div>';
             $data[] = $row;
 
             $total += $item->harga_jual * $item->jumlah - (($item->diskon * $item->jumlah) / 100 * $item->harga_jual);;
             $total_item += $item->jumlah;
         }
         $data[] = [       
            'kode_produk' => '
                <div class="total hide" hidden>'. $total .'</div>
                <div class="total_item hide" hidden>'. $total_item .'</div>',
            'nama_produk' => '',
            'harga_jual'  => '',
            'jumlah'      => '',
            'diskon'      => '',
            'subtotal'    => '',
            'aksi'        => '',
        ];
         return datatables()
             ->of($data)
             ->addIndexColumn()
             ->rawColumns(['aksi', 'kode_produk', 'jumlah'])
             ->make(true);
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
    {

        $produks = Produk::where('kode_produk', $request->kode_produk)->first();
        
        if (!$produks) {
            return response()->json('Data gagal disimpan', 400);
        }

        $detail = new PenjualanDetail();
        $detail->id_penjualan = $request->id_penjualan;
        $detail->kode_produk =  $produks->kode_produk;
        $detail->harga_jual =  $produks->harga_jual;
        $detail->jumlah = 1;
        $detail->diskon =  $produks->diskon;
        $detail->subtotal =  $produks->harga_jual - ( $produks->diskon / 100 *  $produks->harga_jual);;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
     }
    
    //  /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Models\PenjualanDetail  $penjualanDetail
    //  * @return \Illuminate\Http\Response
    //  */
    public function show(PenjualanDetail $penjualanDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenjualanDetail  $penjualanDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PenjualanDetail $penjualanDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenjualanDetail  $penjualanDetail
     * @return \Illuminate\Http\Response
     */
 
     public function update(Request $request, $id)
     {
         
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenjualanDetail  $penjualanDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = PenjualanDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    public function loadForm($diskon = 0, $total = 0, $diterima = 0)
    {
        $bayar   = $total - ($diskon / 100 * $total);
        $kembali = ($diterima != 0) ? $diterima - $bayar : 0;
        $data    = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah'),
            'kembalirp' => format_uang($kembali),
            'kembali_terbilang' => ucwords(terbilang($kembali). ' Rupiah'),
        ];

        return response()->json($data);
    }
}
