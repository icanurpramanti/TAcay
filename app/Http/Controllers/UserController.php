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
        return view('admin.dashboard.user.index', [
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
                'password' => Hash::make($request->password),
                'alamat_user' => $request->alamat_user,
                'no_hp' => $request->no_hp,
            ]
        );



        return redirect('/user')->with('pesan', 'Data Berhasil Di Tambah');
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
        return view('admin.dashboard.user.detail', [
            'users' => User::findOrFail($id)
        ]);
    }

    public function detail($id)
    {
        return view('admin.dashboard.user.detail', [
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
        // Validasi data pengguna
        $validatedData = $request->validate([
            'nama' => 'required|unique:users,nama,' . $id . ',id',
            'level' => 'required',
            'email' => 'required',
            'alamat_user' => 'required',
            'no_hp' => 'required',
        ]);

        // Ambil data pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Cek apakah ada pengisian ulang foto pengguna
        if ($request->hasFile('foto_user')) {
            // Hapus foto lama jika ada
            $oldFilename = $user->foto_user;
            if ($oldFilename && File::exists('produk_image/' . $oldFilename)) {
                File::delete('produk_image/' . $oldFilename);
            }

            // Pindahkan foto baru ke direktori dan simpan namanya
            $filename = time() . "." . $request->foto_user->getClientOriginalExtension();
            $request->file('foto_user')->move('produk_image', $filename);
            $user->foto_user = $filename;
        }

        // Update data pengguna
        $user->nama = $request->nama;
        $user->level = $request->level;
        $user->email = $request->email;
        $user->alamat_user = $request->alamat_user;
        $user->no_hp = $request->no_hp;

        // Simpan perubahan
        $user->save();

        return redirect()->route('user.index')->with('success', 'Data Berhasil Diubah!!!');
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
        return redirect('/user')->with('pesan', 'Data Berhasil Di hapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $users = User::where('nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('admin.dashboard.user.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
