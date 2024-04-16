<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\User;

use Illuminate\Http\Request;

class AboutController extends Controller
{
        public function index(Request $request)
    {
        $team = About::all();
        return view('pets.about-us', ['team' => $team,'user'=>User::all(),
    ]);
    }
}
