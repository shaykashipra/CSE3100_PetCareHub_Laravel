<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
public function printPrescription($id) {
    $prescription = Appointment::with('doctor')->findOrFail($id);
    
    return view('clinic.print', compact('prescription'));
}
}
