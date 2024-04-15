<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class IndexController extends Controller
{
 public function edit(){
      $pets = Pet::where('is_adopted', 0)->inRandomOrder()->take(5)->get();
       
       return view('pets.index',compact('pets'));
    }


    
public function removeFav( $petId)
{           
    if (session()->has('user_id')) {
        $userId = session()->get('user_id');
        $favorites = session()->get('favourites', []);
        if (($key = array_search($petId, $favorites)) !== false) {
            Favourite::where('user_id', $userId)->where('pet_id', $petId)->delete();
            unset($favorites[$key]);
            session()->put('favourites', $favorites);
        }
        return Redirect::back()->with('status', 'fav-removed');
    } else {
        return Redirect::to('/login')->with('error', 'User is not logged in.');
    }
}


public function addFav( $petId)
{


    if (session()->has('user_id')) {
        $userId = session()->get('user_id');
        $favorites = session()->get('favourites', []);

        if (!in_array($petId, $favorites)) {

        $isFavorite = Favourite::where('user_id', $userId)
            ->where('pet_id', $petId)
            ->exists(); 

            if (!$isFavorite) {
             Favourite::create([
                'user_id' => $userId,
                'pet_id' => $petId
            ]);
            $favorites[] = $petId;
            $status = 'fav-added';
                session()->put('favourites', $favorites);

        }

        } 

        return Redirect::back()->with('status', 'fav-added');
    } else {
        return Redirect::to('/login')->with('error', 'User is not logged in.');
    }
}




    
}
