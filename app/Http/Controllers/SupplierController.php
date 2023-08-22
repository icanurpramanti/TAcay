<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.supplier.index',[
            'suppliers' => Supplier::orderBy('kode_supplier')->paginate(50)
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.supplier.create');
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
            'nama_supplier' => 'required',
            'no_hp' => 'required',
            'alamat_supplier' => 'required',
        ]);

        $validatedData['kode_supplier'] = Supplier::generateKode();
        Supplier::create($validatedData);
        return redirect('/supplier')->with('pesan','Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    

    public function detail($id)
    {
        return view('admin.dashboard.supplier.detail',[
            'supplier' => Supplier::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dashboard.supplier.edit',[
            'suppliers' =>Supplier::find($id)
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_supplier' => 'required',
            'nama_supplier' => 'required',
            'no_hp' => 'required',
            'alamat_supplier' => 'required',
        ]);
        Supplier::where('id',$id)
        ->update($validatedData);
        return redirect('/supplier')->with('pesan','Data Berhasil Di Ubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect('/supplier')-> with('pesan','Data Berhasil Di hapus');
    }

}
