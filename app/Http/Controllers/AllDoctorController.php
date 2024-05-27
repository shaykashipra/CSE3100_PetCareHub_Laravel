<?php

namespace App\Http\Controllers;
use App\Models\User;


use App\Models\Doctor; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AllDoctorController extends Controller
{
   
        // public function edit()
        // {
        //     $doctors = Doctor::all();
        //     return view('doctor.all_doctor_list', compact('doctors'));
        // }
        public function edit(Request $request)
        {
            // Check if the user_id is present in the session
            if ($request->session()->has('user_id')) {
                // Retrieve the user from the session
                $user = User::find($request->session()->get('user_id'));
    
                // Check if the user is valid and an admin
                if ($user && $user->is_admin == 1) {
                    // Fetch all doctors
                    $doctors = Doctor::all();
    
                    // Return the doctor list view with the data
                    return view('doctor.all_doctor_list', compact('doctors'));
                } else {
                    // Redirect to the login route with an access denied message
                    return Redirect::route('login')->with('message', 'Access Denied. Please log in as an admin.');
                }
            } else {
                // Redirect to the login route if no user_id is found in the session
                return Redirect::route('login')->with('message', 'Access Denied. Please log in.');
            }
        }
        // public function edit(Request $request)
        // {
        //     $doctor = Doctor::findOrFail($request->id);
        //     return view('doctors.edit', compact('doctor'));
        // }
    
        public function update(Request $request)
        {
            $doctor = Doctor::findOrFail($request->get('idEdit'));
            $doctor->doctor_name = $request->get('nameEdit');
            $doctor->specialization = $request->get('specializationEdit');
            $doctor->gender = $request->get('genderEdit');
            $doctor->experience = $request->get('experienceEdit');

            $doctor->save();      
      return redirect()->route('doctors.edit')->with('status', 'Doctor profile updated successfully.');
        }
    
        public function destroy(Request $request)
        {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->delete();
            return redirect()->route('doctors.edit')->with('status', 'Doctor profile deleted successfully.');
        }
    
    
}
