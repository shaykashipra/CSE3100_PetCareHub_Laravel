<?php

namespace App\Http\Controllers;
use App\Models\Doctor; 


use Illuminate\Http\Request;

class AllDoctorController extends Controller
{
   
        public function edit()
        {
            $doctors = Doctor::all();
            return view('doctor.all_doctor_list', compact('doctors'));
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
