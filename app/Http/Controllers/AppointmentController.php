<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\AppointmentRequestStore;
use App\Models\Doctor;

class AppointmentController extends Controller
{
  public function edit(){
    if(session()->has('user_id')){
    $doctors=Doctor::all();

    return view('clinic.appointment_form',compact('doctors'));
    }
    else{
                return redirect()->route('login')->with('status', 'log_in_first');

    }
  }

  public function store(AppointmentRequestStore $request)
{


    if(session()->has('user_id')){
            $appointment = new Appointment;
            $appointment->user_id = session('user_id'); 
            $appointment->pet_name = $request->pet_name;
            $appointment->contact = $request->contact;
            $appointment->doctor_id = $request->doctor_id; 
            $appointment->date = $request->date;
            $appointment->time = $request->time;
            $appointment->symptoms = $request->symptoms;
            $appointment->category = $request->category;
            $appointment->room_id = $request->room_id; 
    //  $appointment->user_id = 1; 
    //         $appointment->pet_name = "Shayka";
    //         $appointment->contact = "01626052742";
    //         $appointment->doctor_id = 1; 
    //         $appointment->date = "2024-04-09";
    //         $appointment->time = "10:00:00";
    //         $appointment->symptoms = "caugh";
    //         $appointment->category ="dog";
    //         $appointment->room_id = "1234"; 
            $appointment->save();


    return redirect('/clinic')->with('status', 'appointment_booked');
    }
    else{
          return redirect()->route('login')->with('status', 'log_in_first');

    }
}
}
