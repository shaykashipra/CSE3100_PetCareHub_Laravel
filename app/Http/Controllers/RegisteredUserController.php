<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{

    public function create(){
        return view('auth.register');
    }
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'fname' => ['required', 'string', 'min:2'],
            'lname' => ['required', 'string', 'min:2'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Check if the email already exists
        // if (User::where('email', $request->email)->exists()) {
        //     return redirect()->back()->with('error', 'Email already exists.');
        // }

        // Create a new user record
        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);
        $user=new User;
        $user->fname=$request->fname;
        $user->lname=$request->lname;

        $user->email=$request->email;
        $user->password=Hash::make($request->password);

        $user->save();
        $user->image='user.png'; 

        // Log in the user manually
     Session::put('user_id', $user->id);
      Session::put('user_name', $user->fname . " " . $user->lname);
      Session::put('user_image', $user->image);
//success
        return redirect('/');
    }
}
