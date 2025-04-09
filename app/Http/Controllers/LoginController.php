<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('Auth.login.login');
    }

    public function loginPost(Request $request){
        $customMessage = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format tidak sesuai',
            'password.required' => 'Password tidak boleh kosong',
        ];

        $validateDataLogin = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            $customMessage
        );

        if(Auth::attempt($validateDataLogin)){
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->with([
                'gagal' => 'Email atau password salah'
            ]);
        }
    }
}
