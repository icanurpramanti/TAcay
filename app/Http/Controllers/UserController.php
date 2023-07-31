<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard.user.index',[
            'users' =>  User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'nama' => 'required',
            'level' => 'required',
            'email' => 'required',
            'foto_user' => 'required',
            'password' => 'required',
            'alamat_user' => 'required',
            'no_hp' => 'required',

        ]);

        $filename = time() . "." . $request->foto_user->getClientOriginalExtension();
        $request->file('foto_user')->move('produk_image', $filename);

         // Jika validasi tidak ada, maka lakukan simpan data

         $save = User::create(
            [
            'nama' => $request->nama,
            'level' => $request->level,
            'email' => $request->email,
            'foto_user' => $filename,
            'password' =>\Hash::make($request->password),
            'alamat_user' => $request->alamat_user,
            'no_hp' => $request->no_hp,
            ]
        );

        
    
        return redirect('/user')->with('pesan','Data Berhasil Di Tambah');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
        // $user= User::findOrfail($id);
        return view('admin.dashboard.user.detail',[
            'users'=>User::findOrFail($id)
        ]);
    }

    public function detail($id)
    {
        return view('admin.dashboard.user.detail',[
            'user' => User::findOrFail($id)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.dashboard.user.edit', [
            'users' => User::find($id)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
   
     public function update(Request $request, $id)
     {
         $validatedData = $request->validate([
             'nama' => 'required|unique:users,nama,' . $id . ',id',
             'level' => 'required',
             'email' => 'required',
             'password' => 'required',
             'alamat_user' => 'required',
             'no_hp' => 'required',
         ]);
 
         if ($request->file('foto_user') == NULL) {
             $update = User::where('id', $id)->update([
                 'nama' => $request->nama,
                 'level' => $request->level,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
                 'alamat_user' => $request->alamat_user,
                 'no_hp' => $request->no_hp,
             ]);
 
             return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah!!!');
         } else {
             File::delete('produk_image/' . $request->foto_user_lama);
 
             $filename = time() . "." . $request->foto_user->getClientOriginalExtension();
             $request->file('foto_user')->move('produk_image', $filename);
 
             $update = User::where('id', $id)->update([
                 'nama' => $request->nama,
                 'level' => $request->level,
                 'email' => $request->email,
                 'foto_user' => $filename,
                 'password' => Hash::make($request->password),
                 'alamat_user' => $request->alamat_user,
                 'no_hp' => $request->no_hp,
             ]);
         }
 
         return redirect('/user')->with('pesan', 'Data Berhasil Di Ubah');
     }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user')-> with('pesan','Data Berhasil Di hapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $users = User::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.dashboard.user.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
