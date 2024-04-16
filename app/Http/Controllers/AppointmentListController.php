<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAppointmentUpdate;
use App\Http\Requests\AppointmentRequestStore;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentListController extends Controller
{
    public function index(){
                    $user = User::find(session('user_id'));

    if(session()->has('user_id')){
                $appointments = $user->appointments()->with('doctor')->get();

        return view('clinic.appointment_list',compact('user', 'appointments'));
    }else {
        return redirect()->route('login');
    }
}





    public function update(Request $request){
//   dd($request->get('idEdit'));

    $appointment = Appointment::find($request->idEdit);
    $appointment["doctor_id"] = $request->doctorEdit;
    $appointment["date"] = $request->dateEdit;
    $appointment["time"] = $request->timeEdit;
    $appointment["room_id"] = $request->roomEdit;
    $appointment["status"] = $request->statusEdit;
    //          $meetingDetails = session('meeting_details');
            
    //         // Update the appointment with meeting details
    //         $appointment->start_url = $meetingDetails['start_url'];
    //         $appointment->join_url = $meetingDetails['join_url'];
    //         $appointment->meeting_id = $meetingDetails['meeting_id'];
    //         $appointment->meeting_password = $meetingDetails['meeting_password'];

    //         // Optionally, clear the meeting details from the session after saving
    //         session()->forget('meeting_details');
        
    $appointment->save();
    return redirect()->route('admin_app_list.edit')->with('status', 'appointment_updated');    
    }


      public function destroy(Request $request){
        $appointment=Appointment::find($request->get('id'));
    if ($appointment && $appointment->delete()) {
        return redirect()->route('admin_app_list.edit')->with('status', 'appointment-deleted');
    } else {
        return redirect()->route('admin_app_list.edit')->with('status', 'appointment-delete-failed');
    }
    }

}
