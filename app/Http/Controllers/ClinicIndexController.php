<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClinicIndexController extends Controller
{
    public function index(){
       if(session('user_id') && User::find(session('user_id'))){
        $user=User::findOrFail(session('user_id'));
        return view('clinic.index',compact('user'));

       }
       else{
        return redirect('/login')->with('log_in_first');
       }
    }
}
