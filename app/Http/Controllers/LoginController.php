<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()){
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {

        $credentials =$request ->validate([
            'email'=>'required',
            'password' => 'required'
        ]);


        if(Auth::attempt($credentials)){
            if(Auth::user()->level=='admin'){
                return redirect('/home');
            }
            if(Auth::user()->level=='kasir'){
                return redirect('/homee');
            }
        }
        

        // if(auth::attempt($request->only('email','password'))){
        //     // return 'sukses';
        //     return redirect ('home');
        // }else {
        //     // return 'gagal';
        //     Session::flash('error','Email atau Password Salah');
        //         return redirect('/login');
        // }

    }

    public function actionlogout(){
        Auth::logout();
        return redirect('/login');
    }
}
