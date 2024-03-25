<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerateToken();
        
        return redirect('/');
    }

        public function logoutDoc(Request $request)
    {
        $request->session()->flush();

        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
