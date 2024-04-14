<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function edit(Request $request){
        return view('pets.settings',[
            'user'=>User::find($request->session()->get('user_id'))
        ]);
    }

    public function update(SettingsRequest $request)
    {
   // Retrieve the user ID from the session
    $userId = $request->session()->get('user_id');
        //  dd($request);

    // Find the user by ID
    $user = User::find($userId);
    //  dd($user);
    // Check if the user exists
    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    // Validate the current password
    if (!Hash::check($request->input("current_password"), $user->password)) {
        return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }
        $user->password=Hash::make($request->input('password'));

        $user->save();

        // return Redirect::route('settings.edit')->with('status', 'password-updated');
            return back()->with('status', 'password-updated');

    }

    public function destroy(Request $request)
    { 
 $user = User::find($request->session()->get('user_id'));

    if (!$user) {
        return redirect()->route('login')->with(['status' => 'User not found.']);
    }

    $del_password = $request->input('del_password');

    if (!Hash::check($del_password, $user->password)) {
            return back()->with('status', 'wrong-password');
    }

    $user->delete();

    return redirect()->route('logout');    }
}