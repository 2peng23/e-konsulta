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
            } else {
                return view('admin.home');
            }
        }
        return redirect()->back();
    }
}
