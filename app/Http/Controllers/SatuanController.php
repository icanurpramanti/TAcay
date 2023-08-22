<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.satuan.index',[
            'satuans' => Satuan::orderBy('kode_satuan')->paginate(50)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.satuan.create');
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
            'nama_satuan' => 'required',
        ]);

        $validatedData['kode_satuan'] = Satuan::generateKode();

        Satuan::create($validatedData);

        return redirect('/satuan')->with('pesan', 'Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */


    public function detail($id)
    {
        return view('admin.dashboard.satuan.detail',[
            'satuan' => Satuan::findOrFail($id)
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dashboard.satuan.edit',[
            'satuans' =>Satuan::find($id)
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
         $validatedData = $request->validate([
            'kode_satuan' => 'required',
            'nama_satuan' => 'required',
        ]);
        Satuan::where('id',$id)
            ->update($validatedData);
        return redirect('/satuan')->with('pesan','Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Satuan::destroy($id);
        return redirect('/satuan')-> with('pesan','Data Berhasil Di hapus');
    }

}
