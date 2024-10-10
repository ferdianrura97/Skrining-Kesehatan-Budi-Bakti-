<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaAuthController extends Controller
{

    public function login()
    {
        if(Auth::guard('staff')->check()){
            return redirect()->route('dashboard')->with('error', 'Anda sudah login sebagai staff/admin, Harap logout terlebih dahulu');
        }
        
        if(Auth::guard('siswa')->check()){
            return redirect()->route('dashboard');
        }
        return view('auth.siswa.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('siswa')
               ->attempt($req->only(['nomor_induk', 'password'])))
        {
            return redirect()
                ->route('dashboard');
        }

        return redirect()
            ->back()
            ->with('loginError', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::guard('siswa')
            ->logout();

        return redirect()
            ->route('siswa.login');
    }
}
