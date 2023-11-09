<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function makeAppointment($id)
    {
        $doctor = Doctor::find($id);
        return view('user.make-appointment', compact('doctor'));
    }
}
