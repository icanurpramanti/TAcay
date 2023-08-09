<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $satuans = Satuan::all();
        $produks = Produk::latest()->paginate(7);

        return view('admin.dashboard.produk.index', compact('kategoris', 'produks', 'satuans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.produk.create', [
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'kode_kategori' => 'required',
            'kode_satuan' => 'required',
            'harga_beli' => 'required',
            'diskon' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        $validatedData['kode_produk'] = Produk::generateKode();

        Produk::create($validatedData);
        return redirect('/produk')->with('pesan', 'Data Berhasil Di Tambah');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $id)
    {
        // $produk= Produk::findOrfail($id);
        return view('admin.dashboard.produk.detail', [
            'produks' => Produk::findOrFail($id)
        ]);
    }

    public function detail($id)
    {
        return view('admin.dashboard.produk.detail', [
            'produk' => Produk::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        return view('admin.dashboard.produk.edit', [
            'produks' => Produk::find($id),
            'kategoris' => Kategori::all(),
            'satuans' => Satuan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'kode_kategori' => 'required',
            'kode_satuan' => 'required',
            'harga_beli' => 'required',
            'diskon' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);


        Produk::where('id', $id)->update($validatedData);
        return redirect('/produk')->with('pesan', 'Data Berhasil Di Ubah');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produk::destroy($id);
        return redirect('/produk')->with('pesan', 'Data Berhasil Di hapus');
    }

    public function searchproduk(Request $request)
    {
        $keyword = $request->search;
        $produks = Produk::where('nama_produk', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.dashboard.produk.index', compact('produks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
