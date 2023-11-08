<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function doctor()
    {
        return view('admin.doctor');
    }
    public function staff()
    {
        return view('admin.staff');
    }
    public function patient()
    {
        return view('admin.patient');
    }
    public function appointment()
    {
        return view('admin.appointment');
    }
    public function report()
    {
        return view('admin.report');
    }
}
