<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(SettingsRequest $request)
    {
 $userId = $request->session()->get('user_id');

    $user = User::find($userId);
    // Check if the user exists
    if (!$user) {
        // Handle the case where the user is not found
        return redirect()->back()->with('error', 'User not found.');
    }

    // Validate the current password
    if (!Hash::check($request->current_password, $user->password)) {
        return redirect()->back()->with(['status' => 'password-updated-failed']);
    }
        $user->password=Hash::make($request->password);

        $user->save();

        // return Redirect::route('settings.edit')->with('status', 'password-updated');
            return back()->with('status', 'password-updated');

    }
}
