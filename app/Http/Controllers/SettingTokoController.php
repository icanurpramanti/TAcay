<?php

namespace App\Http\Controllers;

use App\Models\SettingToko;
use Illuminate\Http\Request;

class SettingTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.setting_toko.index',[
            'setting_tokos' =>  SettingToko::latest()->paginate(7)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.setting_toko.create');
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
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
            'no_hp' => 'required',
            'instagram' => 'required',
            'email' => 'required',

        ]);
        SettingToko::create($validatedData);
        return redirect('/setting_toko')->with('pesan','Data Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingToko  $settingToko
     * @return \Illuminate\Http\Response
     */
     public function show(SettingToko $id)
    {
        // $setting_toko= SettingToko::findOrfail($id);
        return view('admin.dashboard.setting_toko.detail',[
            'setting_tokos'=>SettingToko::findOrFail($id)
        ]);
    }

    public function detail($id)
    {
        return view('admin.dashboard.setting_toko.detail',[
            'setting_toko' => SettingToko::findOrFail($id)
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingToko  $settingToko
     * @return \Illuminate\Http\Response
     */
    
        public function edit($id)
    {
        return view('admin.dashboard.setting_toko.edit',[
            'setting_tokos' =>SettingToko::find($id)
    
       ]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingToko  $settingToko
     * @return \Illuminate\Http\Response
     */
  public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
            'no_hp' => 'required',
            'instagram' => 'required',
            'email'=>'required',
        ]);
        SettingToko::where('id',$id)
            ->update($validatedData);
        return redirect('/setting_toko')->with('pesan','Data Berhasil Di Ubah');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingToko  $settingToko
     * @return \Illuminate\Http\Response
     */
  public function destroy($id)
    {
        SettingToko::destroy($id);
        return redirect('/setting_toko')-> with('pesan','Data Berhasil Di hapus');
    }

 
}
