<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.kategori.index', [
            'kategoris' =>  Kategori::latest()->paginate(7)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.kategori.create');
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
            'nama_kategori' => 'required',
        ]);

        $validatedData['kode_kategori'] = Kategori::generateKode();

        Kategori::create($validatedData);

        return redirect('/kategori')->with('pesan', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $id)
    {
        // $kategori= Kategori::findOrfail($id);
        return view('admin.dashboard.kategori.detail', [
            'kategoris' => Kategori::findOrFail($id)
        ]);
    }

    public function detail($id)
    {
        return view('admin.dashboard.kategori.detail', [
            'kategori' => Kategori::findOrFail($id)
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dashboard.kategori.edit', [
            'kategoris' => Kategori::find($id)

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_kategori' => 'required',
            'nama_kategori' => 'required',
        ]);
        Kategori::where('id', $id)
            ->update($validatedData);
        return redirect('/kategori')->with('pesan', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect('/kategori')->with('pesan', 'Data Berhasil Di hapus');
    }

    public function searchkategori(Request $request)
    {
        $keyword = $request->search;
        $kategoris = Kategori::where('nama_kategori', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.dashboard.kategori.index', compact('kategoris'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
