<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // switch ($guard) {
            //     case 'websiswa':
            //         if (Auth::guard($guard)->check()) {
            //         return redirect()->route('siswa.home');
            //         }
            //         break;
            //     case 'webstaff':
            //         if (Auth::guard($guard)->check()) {
            //         return redirect()->route('staff.home');
            //         }
            //         break;
            //     default:
            //         if (Auth::guard($guard)->check()) {
            //             return redirect('/tes'); 
            //         }
            //         break;
            //     }
        
            //     return $next($request);
            // if (Auth::guard($guard)->check()) {
            //     if(Auth::guard('webstaff')->check()){
            //         return redirect()->route('staff.home');
            //     }
                
            //     if(Auth::guard('websiswa')->check()){
            //         return redirect()->route('siswa.home');
            //     }
            // }
        }

        return $next($request);
    }
}
