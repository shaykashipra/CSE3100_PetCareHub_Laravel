<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Characteristic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\PetProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        // Check if user is authenticated manually
    // $user = null;
    if ($request->session()->has('user_id')) {
        $user = User::find($request->session()->get('user_id'));
    }

    // If user is not found, redirect to login
    if (!$user) {
        return redirect()->route('login')->with('error', 'Please log in to access your profile.');
    }

        $provinces=[  'Dhaka',
    'Chittagong',
    'Rajshahi',
    'Khulna',
    'Barisal',
    'Sylhet',
    'Rangpur',
    'Mymensingh'];
        $age=['Baby','Young','Adult','Senior'];
        $gender=['Male','Female'];
        $characteristics=['Cute','Loyal','Friendly','Playful','Intelligent','Happy','Affectionate','Courageous'];
        $coat_lengths=['Hairless','Short','Medium','Long'];

    $pets = Pet::with('characteristics')->where('user_id', $user->id)->get();
        return view('pets.profile', [
            'provinces'=>$provinces,
            'ages'=>$age,
            'genders'=>$gender,
            'characteristics'=>$characteristics,
            'coat_lengths'=>$coat_lengths,
            'user' => $user,
            'pets'=>$pets
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {

    $user = User::find($request->session()->get('user_id'));
        if($request->hasFile('image')){
            $destination='uploads/'.$user->image;
            if(File::exists($destination)){
                if($destination!='uploads/user.png'){
                    File::delete($destination);
                }
            }
            $imagePath=time().$request->image->getClientOriginalName();
            $request->image->move(public_path('uploads'),$imagePath);
            $user->image=$imagePath;

        }
        
        $user->fname=$request->get('fname');
        $user->lname=$request->get('lname');
        $user->phone=$request->get('phone');
        $user->street=$request->get('streetAddress');
        $user->city=$request->get('city');
        $user->province=$request->get('province');
        $user->postal_code=$request->get('postal_code');
        session()->put('user_image', $user->image);

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function petUpdate(PetProfileUpdateRequest $request){
        // // Validation
        // $this->validate($request,[
        //     'petnameEdit' => 'required|string',
        //     'ageEdit' => 'required',
        //     'genderEdit' => 'required|string',
        //     'colorEdit' => 'required|string',
        //     'characteristic' => 'required',
        //     'coatEdit' => 'required|string',
        //     'statusEdit'=>'required|string',
        //     'descriptionEdit' => 'required|string'
        // ]);
        
        $pet=Pet::find($request->get('idEdit'));
        $pet->pet_name=$request->get('petnameEdit');
        $pet->age=$request->get('ageEdit');
        $pet->gender=$request->get('genderEdit');
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
                'created_at'=>$pet->created_at,
                'updated_at'=>$pet->updated_at,
            ];
        }
        DB::table('characteristics')->insert($data);
        return redirect()->route('profile.edit')->with('status', 'pet-updated');
    }

    /**
     * Logout user account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
$request->validate([
        'password' => ['required'],
    ]);

    $user = User::find($request->session()->get('user_id'));

    // Check if the provided password matches the user's password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Incorrect password.');
    }

    // Unset the user session data
    $request->session()->forget('user_id');

    // Regenerate the session token
    $request->session()->regenerate();

    // Redirect the user to the homepage
    return redirect()->to('/')->with('status', 'You have been successfully logged out.');
    }

    // Delete Pet Record
    public function petDelete(Request $request){
        Characteristic::where('pet_id',$request->get('pet_id'))->delete();
        Pet::find($request->get('pet_id'))->delete();
        return redirect()->route('profile.edit')->with('status', 'pet-deleted');
    }
}
