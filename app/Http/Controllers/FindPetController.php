<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequestManager;

class FindPetController extends Controller
{
    public function findDogs(Request $request)
    {
        $type = $request->get('type');
        $gender = $request->get('gender');
        $age = $request->get('age');
        // $breed = $request->get('breed');
        $coat = $request->get('coat');
        $city = $request->get('city');

    $query = Pet::where('animal_type', $type);
        
        if ($gender && $gender !== "any") {
            $query->where('gender', $gender);
        }
        if ($age && $age !== "any") {
            $query->where('age', $age);
        }
    //have to modify this part
        // if ($breed && $breed !== "any") {
        //     $query->whereHas('characteristics', function ($q) use ($breed) {
        //         $q->where('characteristic', 'breed')->where('value', $breed);
        //     });
        // }
        if ($coat && $coat !== "any") {
            $query->whereHas('characteristics', function ($q) use ($coat) {
                $q->where('characteristic', 'coat_length')->where('value', $coat);
            });
        }
        if ($city && $city !== "any") {
            $query->whereHas('characteristics', function ($q) use ($city) {
                $q->where('characteristic', 'location')->where('value', $city);
            });
        }

        $dogs = $query->where('is_adopted', 0)->get();
        return view('pets.filter-pets', [
            'pets' => $dogs,
            'user' =>User::find( $request->session()->get('user_id')),
        ]);
    }

  

    public function petProfile($id,$type)
    {

        if($type==='profile'){
        $pet = Pet::with('characteristics')->find($id);
        $pet_address=User::find($pet['user_id']);

        return view('pets.pet-profile', compact('pet','pet_address'));
        }

        else if($type==='contact'){
            $user=User::find(session('user_id')); 
               return view('pets.contact', compact('user'));
     
        }
    }

    public function contactOwner($id)
    {
        $pet = Pet::find($id);
        return view('pets.contact-owner', compact('pet'));
    }
}