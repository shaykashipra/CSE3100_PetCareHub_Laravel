<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Characteristic;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;
use App\Http\Requests\PetsAdminRequest;
use Illuminate\Support\Facades\Redirect;

class PetsController extends Controller
{
  public function edit(Request $request){
    if ($request->session()->has('user_id')) {
        // Retrieve the user from the session
        $user = User::find($request->session()->get('user_id'));

        // // Check if the user is valid and an admin
        if ($user && $user->is_admin == 1) {
        // Arrays for dropdown, radio buttons
        $age=['Baby','Young','Adult','Senior'];
        $gender=['Male','Female'];
        $characteristics=['Cute','Loyal','Friendly','Playful','Intelligent','Happy','Affectionate','Courageous'];
        $animal_types=['Dog','Cat','Rabbit','Fish','Bird','Other'];
        $coat_lengths=['Hairless','Short','Medium','Long'];

        // Getting data from characteristics table for specific pet
        $pets=Pet::with('characteristics')->get();
        return view('pets.pets',[
            'ages'=>$age,
            'genders'=>$gender,
            'characteristics'=>$characteristics,
            'animal_types'=>$animal_types,
            'coat_lengths'=>$coat_lengths,
            'user' => User::all(),
            'pets'=>$pets,
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

    public function update(PetsAdminRequest $request){
        // // Validation
        // $this->validate($request,[
        //     'petnameEdit' => 'required|string',
        //     'ageEdit' => 'required',
        //     'genderEdit' => 'required|string',
        //     'animalTypeEdit' => 'required|string',
        //     'colorEdit' => 'required|string',
        //     'characteristic' => 'required',
        //     'coatEdit' => 'required|string',
        //     'statusEdit'=>'required|string',
        //     'descriptionEdit' => 'required|string'
        // ]);
        
        // Find pet by id
        $pet=Pet::find($request->get('idEdit'));
        $pet->pet_name=$request->get('petnameEdit');
        $pet->age=$request->get('ageEdit');
        $pet->gender=$request->get('genderEdit');
        $pet->animal_type=$request->get('animalTypeEdit');
        $pet->color=$request->get('colorEdit');
        $pet->coat_length=$request->get('coatEdit');
        $pet->is_adopted=$request->get('statusEdit');
        $pet->description=$request->get('descriptionEdit');
        $pet->save();
        
        // First delete all the characteristics for that pet_id then insert new records
        Characteristic::where('pet_id',$request->get('idEdit'))->delete();
        $data = [];
        foreach ($request->characteristic as $c) {
            $data[] = [
                'pet_id' => $request->get('idEdit'),
                'characteristic' => $c,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }
        DB::table('characteristics')->insert($data);
        return redirect()->route('pets.edit')->with('status', 'pet-updated');
    }

    public function destroy(Request $request){
        Characteristic::where('pet_id',$request->get('pet_id'))->delete();
        $pet=Pet::find($request->get('pet_id'));
        
        // Delete pet image from file system
        $destination='uploads/'.$pet->pet_image;
        if(File::exists($destination)){
            File::delete($destination);
        }   
        $pet->delete();
        return redirect()->route('pets.edit')->with('status', 'pet-deleted');
    }
}
