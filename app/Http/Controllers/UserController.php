<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Http\Requests\PatientRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Package;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $appoint = Appointment::where('date', $date)->where('doctor', $doctor)->get();
        $disabledTime = $appoint->isNotEmpty() ? $appoint->pluck('time')->toArray() : [];

        $timeOptions = collect($sched->time)->map(function ($item) use ($disabledTime) {
            $disabled = in_array($item, $disabledTime) ? 'disabled' : '';
            $scheduled = in_array($item, $disabledTime) ? 'scheduled' : '';
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

        $existing_appoint = Appointment::where('name', $request->name)->where('status', 'pending')->first();
        if ($existing_appoint) {
            return response()->json([
                'error' => 'You still have pending appointment!'
            ]);
        }



        $appoint = new Appointment();
        $appoint->user_id = Auth::user()->id;
        $appoint->name = $request->name;
        $appoint->date = $date;
        $appoint->time = $time;
        $appoint->phone = $request->phone;
        $appoint->email = $request->email;
        $appoint->message = $request->message;
        $appoint->doctor = $doctor;
        $appoint->save();

        return response()->json([
            'success' => 'Appointment created!'
        ]);
    }
    public function myAppointment()
    {
        return view('user.appointment');
    }
    public function addPatient(PatientRequest $request)
    {
        $name = $request->name;
        $existing = Patient::whereName($name)->first();
        if ($existing) {
            return response()->json([
                'error' => 'Patient already exist! No need to fill-up this form.'
            ]);
        }
        $patient = new Patient();
        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->address = $request->address;
        $patient->age = $request->age;
        $patient->sex = $request->sex;
        $patient->birthday = $request->birthday;
        $patient->civil_status = $request->civil_status;
        $patient->father_name = $request->father_name;
        $patient->mother_name = $request->mother_name;
        $patient->father_occupation = $request->father_occupation;
        $patient->mother_occupation = $request->mother_occupation;
        $patient->referred = $request->referred;
        $patient->save();
        return response()->json([
            'success' => 'Patient added successfully!'
        ]);
    }
    public function cancelAppointment(Request $request)
    {
        $id = $request->id;
        $appoint = Appointment::where('id', $id)->first();
        $appoint->time = '0:00';
        $appoint->status = 'cancelled';
        $appoint->save();
        return response()->json([
            'error' => 'Appointment cancelled'
        ]);
    }
    public function getPatientInfo(Request $request)
    {
        $id = $request->id;
        $appoint = Appointment::where('id', $id)->first();
        return response()->json([
            'name' => $appoint->name,
        ]);
    }

    public function morePackage()
    {
        return view('user.package');
    }
    public function availPackage($id)
    {
        $package = Package::find($id);
        return view('user.avail-package', compact('package'));
    }
}
