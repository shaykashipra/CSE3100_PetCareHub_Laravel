<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pet;
use App\Models\User;
use App\Events\PetAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddPetRequest;
use App\Notifications\PetAddedNotification;

class AddPetController extends Controller
{
  public function edit(Request $request)
    {
            $user = User::find($request->session()->get('user_id'));

        return view('pets.add-pet', [
            'user' =>$user,
            'gender'=>['Male','Female'],
            'characteristics'=>['Cute','Loyal','Friendly','Playful','Intelligent','Happy','Affectionate','Courageous'],
            'age'=>['Baby','Young','Adult','Senior'],
            'animal_type'=>['Dog','Cat','Rabbit','Bird','Fish','Other'],
            'coat'=>['Hairless','Short','Medium','Long']
        ]);
    }

    public function store(AddPetRequest $request)
    {

        // Pet
        $pet = new Pet;
        $imagePath = time() . $request->pet_image->getClientOriginalName();
        $request->pet_image->move(public_path('uploads'), $imagePath);
        $pet->pet_image = $imagePath;

        $pet->user_id = $request->get('id');
        $pet->pet_name = $request->get('pet_name');
        $pet->age = $request->get('age');
        $pet->gender = $request->get('gender');
        $pet->animal_type = $request->get('animalType');
        $pet->coat_length = $request->get('coat');
        $pet->color = $request->get('color');
        $pet->description = $request->get('description');
        $pet->save();


        // Adding characteristics in table
        $data = [];
        foreach ($request->characteristic as $c) {
            $data[] = [
                'pet_id' => $pet->id,
                'characteristic' => $c,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }
        DB::table('characteristics')->insert($data);
        $users = User::all();
        foreach ($users as $user) {
            $user->notify(new PetAddedNotification($pet));
        }

        return redirect()->route('add-pet.edit')->with('status', 'pet-added');
    }
}
