<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype == 0) {
                $doctor = Doctor::all();
                return view('user.home', compact('doctor'));
            } elseif (Auth::user()->usertype == 1) {
                return view('admin.home');
            } elseif (Auth::user()->usertype == 2) {
                return view('doctor.home');
            } elseif (Auth::user()->usertype == 3) {
                return view('staff.home');
            }
        }
        return redirect()->back();
    }
}
