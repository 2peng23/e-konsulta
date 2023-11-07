<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->usertype == 0) {
                return view('user.home');
            } else {
                return view('admin.home');
            }
        }
        return redirect('/login');
    }
}
