<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function doctorSched()
    {
        return view('doctor.sched');
    }
    public function addSched(Request $request)
    {
        $sched = new Schedule();
        $sched->name = $request->name;
        $sched->date = $request->date;
        $sched->time = $request->time;
        $sched->save();
        return redirect()->back();
    }
    public function getTime(Request $request)
    {
        $date = $request->date;
        $sched = Schedule::where('date', $date)->first();

        $timeOptions = collect($sched->time)->map(function ($item) {
            return "<option value=\"$item\">$item</option>";
        })->implode('');

        $selectDropdown = "<select class=\"form-select\" name=\"time\">$timeOptions</select>";

        return response()->json(['output' => $selectDropdown]);
    }
}
