<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthController extends Controller
{

    public function login()
    {
        if(Auth::guard('siswa')->check()){
            return redirect()->route('dashboard')->with('error', 'Anda sudah login sebagai siswa, Harap logout terlebih dahulu');
        }

        if(Auth::guard('staff')->check()){
            return redirect()->route('dashboard');
        }
        
        return view('auth.staff.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('staff')
               ->attempt($req->only(['username', 'password'])))
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
        Auth::guard('staff')
            ->logout();

        return redirect()
            ->route('staff.login');
    }
}
