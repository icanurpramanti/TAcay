<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.bank.index',[
            'banks' =>  Bank::latest()->paginate(7)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.bank.create');
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
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'pemilik_rekening' => 'required',

        ]);
        Bank::create($validatedData);
        return redirect('/bank')->with('pesan','Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dashboard.bank.edit',[
            'banks' =>Bank::find($id)
    
       ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_bank' => 'required',
            'no_rek' => 'required',
            'pemilik_rekening' => 'required',
        ]);
        Bank::where('id',$id)
            ->update($validatedData);
        return redirect('/bank')->with('pesan','Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Bank::destroy($id);
        return redirect('/bank')-> with('pesan','Data Berhasil Di hapus');
    }

    public function searchbank(Request $request)
    {
        $keyword = $request->search;
        $banks = Bank::where('nama_bank', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.dashboard.bank.index', compact('banks'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
