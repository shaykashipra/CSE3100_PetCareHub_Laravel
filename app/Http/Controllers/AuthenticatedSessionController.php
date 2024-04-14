<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
  public function create(){
    return view('auth.login');
  }

   public function login(Request $request)
{   
   // Validate
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Authentication successful
        //session data store
     Session::put('user_id', $user->id);
      Session::put('user_name', $user->fname . " " . $user->lname);
      Session::put('user_image', $user->image);
      Session::put('is_admin', $user->is_admin);

         $favorites = $user->favourites()->pluck('pet_id')->toArray();

            Session::put('favourites', $favorites);
      
        $request->session()->regenerate();

        return redirect('/')->with(compact('user'));
        
        // return redirect()->intended();
        // return redirect()->intended(RouteServiceProvider::HOME);

    }

    //  failed
        return redirect('/login')->withInput($request->except('password'))->withErrors(['email' => 'Invalid Email']);
}


// public function toggleFavorite(Request $request, $petId)
//     {
//         if (Session::has('user_id')) {
//             $userId = Session::get('user_id');
//             $favorites = Session::get('favourites', []);

//             if (in_array($petId, $favorites)) {
//                 $key = array_search($petId, $favorites);
//                 unset($favorites[$key]);
//             } else {
//                 $favorites[] = $petId;
//             }

//             Session::put('favourites', $favorites);

//             return redirect()->back()->with('success', 'Pet added/removed from favorites successfully.');
//         } else {
//             return redirect('/login')->with('error', 'Please login to manage favorites.');
//         }
//     }

 }
