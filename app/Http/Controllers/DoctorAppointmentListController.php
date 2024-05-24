<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorAppointmentListController extends Controller
{
    
    public function index()
    {
$doctorId = session()->get('doc_id');

        if (!$doctorId) {
            return redirect('/doctor/login')->with('error', 'Please log in as a doctor to view appointments.');
        }

        $appointments = Appointment::with('patient')->where('doctor_id', $doctorId)->get();
        return view('doctor.doctor_app_list', compact('appointments'));
    }



    public function edit(Request $request){
      $prescription=$request->prescription;
    if($prescription){
    return redirect()->route('doctor_app_list.update')->with('prescription', $prescription); 
    }   
    else{
        return redirect()->route('doctor_app_list.update')->with('prescription', "Not Available");; 

    }

    }



 public function update(Request $request){
//   dd($request->get('idEdit'));

    $appointment = Appointment::find($request->idEdit);
 
    $appointment["status"] = $request->statusEdit;
    $appointment["prescription"] = $request->prescriptionEdit;

        
    $appointment->save();
    return redirect()->route('doctor_app_list')->with('status', 'appointment_updated');    
    }



          public function destroy(Request $request){
        $appointment=Appointment::find($request->get('id'));
    if ($appointment && $appointment->delete()) {
        return redirect('/doctor/list')->with('status', 'appointment-deleted');
    } else {
        return redirect('/doctor/list')->with('status', 'appointment-delete-failed');
    }
}
}
