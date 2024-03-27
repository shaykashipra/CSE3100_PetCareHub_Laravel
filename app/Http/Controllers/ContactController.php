<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
        public function edit(Request $request){
            $user=User::find($request->session()->get('user_id'));
        return view('pets.contact',compact('user'));
    }
}
