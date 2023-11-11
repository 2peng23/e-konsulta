<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function makeAppointment($id)
    {
        $doctor = Doctor::find($id);
        return view('user.make-appointment', compact('doctor'));
    }
    public function getTime(Request $request)
    {
        $date = $request->date;
        if ($date == '') {
            return response()->json([
                'output' => "<select id=\"selectedTime\" class=\"form-select-sm\" style=\"padding:12px; width:100%;\" name=\"time\">
                <option>Select Time<option/>
                </select>",
            ]);
        }
        $doctor = $request->doctor;
        $sched = Schedule::where('date', $date)->where('name', $doctor)->first();
        $appoint = Appointment::where('date', $date)->where('doctor', $doctor)->first();
        $disabledTime = $appoint ? $appoint->time : null;

        $timeOptions = collect($sched->time)->map(function ($item) use ($disabledTime) {
            $disabled = $disabledTime !== null && $disabledTime == $item ? 'disabled' : '';
            $scheduled = $disabledTime !== null && $disabledTime == $item ? 'scheduled' : '';
            return "<option value=\"$item\" $disabled>$item $scheduled</option>";
        })->implode('');
        $selectDropdown = "<select id=\"selectedTime\" class=\"form-select-sm\" style=\"padding:12px; width:100%;\" name=\"time\">$timeOptions</select>";

        return response()->json(['output' => $selectDropdown]);
    }
    public function createAppointment(AppointmentRequest $request)
    {
        $date = $request->date;
        $doctor = $request->doctor;
        $time = $request->time;

        $existing_appoint = Appointment::where('name', $request->name)->where('status', '!=', 'approved')->first();
        if ($existing_appoint) {
            return response()->json([
                'error' => 'You still have pending appointment!'
            ]);
        }



        $appoint = new Appointment();
        $appoint->name = $request->name;
        $appoint->date = $date;
        $appoint->time = $time;
        $appoint->phone = $request->phone;
        $appoint->email = $request->email;
        $appoint->doctor = $doctor;
        $appoint->save();

        return response()->json([
            'success' => 'Appointment created!'
        ]);
    }
}
