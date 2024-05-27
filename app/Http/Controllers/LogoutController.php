<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerateToken();
        Cookie::queue(Cookie::forget('remember_token'));

        return redirect('/');
    }

        public function logoutDoc(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
