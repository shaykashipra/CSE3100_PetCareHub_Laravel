<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function edit(Request $request)
    {
        // Check if the user_id is present in the session
        if ($request->session()->has('user_id')) {
            // Retrieve the user from the session
            $user = User::find($request->session()->get('user_id'));

            // // Check if the user is valid and an admin
            if ($user && $user->is_admin == 1) {
                // Add the user to the request attributes
                $request->attributes->add(['user' => $user]);

                // Fetch the data needed for the dashboard
                $province_chart = DB::table("users")
                    ->select(DB::raw('province, count(id) as count'))
                    ->where('is_admin', 0)
                    ->groupBy("province")
                    ->get();

                $pets_chart = DB::table("pets")
                    ->select(DB::raw('animal_type, count(animal_type) as count'))
                    ->whereNotNull("animal_type")
                    ->groupBy("animal_type")
                    ->get();

                $is_adopted = Pet::pluck('is_adopted');

                $pets_added_date = DB::table('pets')
                    ->select(DB::raw('count(id) as count, DATE(created_at) as date'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->get();

                // Return the dashboard view with the data
                return view('pets.dashboard', [
                    'user' => $user,
                    'province_chart' => $province_chart,
                    'pets_chart' => $pets_chart,
                    'is_adopted' => $is_adopted,
                    'pets_added_date' => $pets_added_date
                ]);
            } 
            else {
                // Redirect to the login route with an access denied message
                return Redirect::route('login')->with('message', 'Access Denied. Please log in as an admin.');
            }
        }
         else {
            // Redirect to the login route if no user_id is found in the session
            return Redirect::route('login')->with('message', 'Access Denied. Please log in.');
        }
    }

}