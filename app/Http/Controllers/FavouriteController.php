<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FavouriteController extends Controller
{
       public function edit(Request $request)
    {


        $userId = session('user_id');
        $user = User::find($userId);
             if ($user) {
            $pets = $user->favourites()->where('is_adopted', 0)->with(['users' => function($query) {
                $query->select('id', 'city');
            }])->get(['pets.id', 'pets.pet_name', 'pets.pet_image', 'pets.gender', 'pets.user_id']);
        } else {
            return redirect()->back()->withErrors('User not found.');
        }
        // $pets = DB::table('pets')
        //     ->join('favourites', 'pets.id', '=', 'favourites.pet_id')
        //     ->join('users', 'pets.user_id', '=', 'users.id')
        //     ->where('favourites.user_id', session()->get('user_id'))
        //     ->select('pets.id','pets.pet_name', 'pets.pet_image', 'pets.gender', 'users.city')
        //     ->get();
        // return view(
        //     'pets.favourites',
        //     [
        //         'user' => $request->user(),
        //         'pets' => $pets
        //     ]
        // );

       return view('pets.favourites', compact('user', 'pets'));

    }


        public function addFav(Request $request)
    {
        if (session()->has('user_id')) {
            $favourite = new Favourite;
            $favourite->user_id =session('user_id'); 
            $favourite->pet_id = $request->input('pet_id');
            $favourite->save();
            return Redirect::back()->with('success', 'Pet added to favourites successfully');
        } else {
            return redirect()->route('login')->with('error', 'You need to login to add favourites.');
        }
    }
}
