<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.dashboard.pembelian_detail.index');
        $kode_pembelian = session('kode_pembelian');
        $produks = Produk::orderBy('nama_produk')->get();
        $suppliers = Supplier::find('kode_supplier');
        $diskon = Pembelian::find($kode_pembelian)->diskon ?? 0;
        dd($suppliers,$produks,$kode_pembelian);
        if (!$suppliers) {
            echo "supplier ndk ado do";
        } else {
            return view('admin.dashboard.pembelian_detail.index');
        }
    
    }

    public function data($kode_pembeliandetail)
    {
        $detail = PembelianDetail::with('produk')
            ->where('kode_pembelian', $kode_pembeliandetail)
            ->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $row = array();
            $row['kode_produk'] = '<span class="label label-success">'. $item->produk['kode_produk'] .'</span';
            $row['nama_produk'] = $item->produk['nama_produk'];
            $row['harga_beli']  = 'Rp. '. format_uang($item->harga_beli);
            $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->kode_pembelian_detail .'" value="'. $item->jumlah .'">';
            $row['subtotal']    = 'Rp. '. format_uang($item->subtotal);
            $row['aksi']        = '<div class="btn-group">
                                    <button onclick="deleteData(`'. route('admin.dashboard.pembelian_detail.destroy', $item->kode_pembelian_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                                </div>';
            $data[] = $row;

            $total += $item->harga_beli * $item->jumlah;
            $total_item += $item->jumlah;
        }
        $data[] = [
            'kode_produk' => '
                <div class="total hide">'. $total .'</div>
                <div class="total_item hide">'. $total_item .'</div>',
            'nama_produk' => '',
            'harga_beli'  => '',
            'jumlah'      => '',
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
        //
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
        // dd($produks);
        if (!$produks) {
            return response()->json('Data gagal disimpan', 400);
        }
        
        $detail = new PembelianDetail();
        $detail->kode_pembelian = $request->kode_pembelian;
        $detail->kode_produk = $produks->kode_produk;
        $detail->harga_beli = $produks->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produks->harga_beli;
        $detail->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    public function pilihProduk($kode_produk){
        $produks = Produk::where('kode_produk','=',$kode_produk)->get();
        // dd($produks);
        return view('admin.dashboard.pembelian_detail.produk',[
            'produks' => $produks
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PembelianDetail  $pembelianDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PembelianDetail $pembelianDetail,$kode_supplier)
    {
        // return view('admin.dashboard.pembelian_detail.index');
        $kode_pembelian = session('kode_pembelian');
        $produks = Produk::orderBy('nama_produk')->get();
        $suppliers = Supplier::where('kode_supplier', $kode_supplier)->get();
        $diskon = Pembelian::find($kode_pembelian)->diskon ?? 0;
        // dd($suppliers,$produks,$kode_pembelian,$diskon);
        if (!$suppliers) {
            echo "supplier ndk ado do";
        } else {
            return view('admin.dashboard.pembelian_detail.index',[
                'suppliers'=> $suppliers,
                'kode_pembelian'=> $kode_pembelian,
                'diskon' => $diskon,
                'produks' => $produks
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PembelianDetail  $pembelianDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelianDetail $pembelianDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PembelianDetail  $pembelianDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga_beli * $request->jumlah;
        $detail->update();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PembelianDetail  $pembelianDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail = PembelianDetail::find($id);
        $detail->delete();

        return response(null, 204);
    }

    //untuk kalkulasi data
    public function loadForm($diskon, $total)
    {
        $bayar = $total - ($diskon / 100 * $total);
        $data  = [
            'totalrp' => format_uang($total),
            'bayar' => $bayar,
            'bayarrp' => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah')
        ];

        return response()->json($data);
    }

}
