<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchedRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function doctorSched()
    {
        return view('doctor.sched');
    }
    public function addSched(SchedRequest $request)
    {
        $existing = Schedule::where('name', $request->name)->where('date', $request->date)->first();
        if ($existing) {
            return response()->json([
                'error' => 'Schedule date already exist!'
            ]);
        }
        $sched = new Schedule();
        $sched->name = $request->name;
        $sched->date = $request->date;
        $sched->time = $request->time;
        $sched->save();
        return response()->json([
            'success' => 'Schedule created!'
        ]);
    }
}
