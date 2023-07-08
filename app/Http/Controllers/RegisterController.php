<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        $user=User::create([
            'nama'=>$request->nama,
            'level'=>$request->level,
            'email'=>$request->email,
            'foto_user'=>$request->foto_user,
            'password'=>\Hash::make($request->password),
            'alamat_user'=>$request->alamat_user,
            'no_hp'=>$request->no_hp
        ]);

        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect('/login');
    }
}
