<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\SchedRequest;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function doctorAppointment(Request $request)
    {
        $appointment = DB::table('appointments')->where('doctor', Auth::user()->name)->orderBy('updated_at', 'desc');
        $app_name = $request->app_name;
        $app_date = $request->app_date;
        if ($app_name) {
            $appointment = $appointment->where(function ($query) use ($app_name) {
                $query->where('name', 'like', "%{$app_name}%");
            });
        }
        if ($app_date) {
            $appointment = $appointment->where(function ($query) use ($app_date) {
                $query->where('date', 'like', "%{$app_date}%");
            });
        }
        $appointment = $appointment->paginate(5);
        $appointment->appends(['app_name' => $app_name]);
        $appointment->appends(['app_date' => $app_date]);
        return view('doctor.appointment', compact('appointment', 'app_name', 'app_date'));
    }

    public function approve($id)
    {
        $appoint = Appointment::where('doctor', Auth::user()->name)->where('id', $id)->first();
        $appoint->status = 'approved';
        $appoint->save();

        $details = [
            'greetings' => 'Dear Mr/Mrs ' . $appoint->name . ',',
            'body' => 'Your appointment with Doctor ' . $appoint->doctor . ' on ' . date('l,F d, Y', strtotime($appoint->date)) . ' ' . $appoint->time . ' has been approved. Kindly go to our hospital based on your appointment schedule.',
            // 'actiontext' => 'View appointment details ',
            // 'actionurl' => url('myappointment'),
            'endpart' => ' Thank You!'
        ];
        // Construct the request body
        $body = [
            'number' => $appoint->phone,
            'message' => $details['greetings'] . $details['body'] . $details['endpart'],
            'sendername' => 'Birung',
            'apikey' => 'bf09f02bd326ac4b087d104786368fdf' // Replace with your Semaphore API key
        ];

        // Send the request using Guzzle HTTP client
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.semaphore.co/api/v4/messages', [
            'form_params' => $body
        ]);
        // Check the response status code
        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            // SMS sent successfully
            return response()->json([
                'success' => 'Patient successfully notified!'
            ]);
        } else {
            // SMS sending failed
            return response()->json(['error' => 'SMS sending failed']);
        }
    }
    public function decline($id)
    {
        $appoint = Appointment::where('doctor', Auth::user()->name)->where('id', $id)->first();
        $appoint->status = 'declined';
        $appoint->save();

        $details = [
            'greetings' => 'Dear Mr/Mrs ' . $appoint->name . ',',
            'body' => 'Your appointment with Doctor ' . $appoint->doctor . ' on ' . date('l,F d, Y', strtotime($appoint->date)) . ' ' . $appoint->time . ' has been declined. Sorry for the inconvenience, please create another appointment.',
            // 'actiontext' => 'View appointment details ',
            // 'actionurl' => url('myappointment'),
            'endpart' => ' Thank You!'
        ];
        // Construct the request body
        $body = [
            'number' => $appoint->phone,
            'message' => $details['greetings'] . $details['body'] . $details['endpart'],
            'sendername' => 'Birung',
            'apikey' => 'bf09f02bd326ac4b087d104786368fdf' // Replace with your Semaphore API key
        ];

        // Send the request using Guzzle HTTP client
        $client = new \GuzzleHttp\Client();
        $response = $client->post('https://api.semaphore.co/api/v4/messages', [
            'form_params' => $body
        ]);
        // Check the response status code
        $statusCode = $response->getStatusCode();
        if ($statusCode === 200) {
            // SMS sent successfully
            return response()->json([
                'success' => 'Patient successfully notified!'
            ]);
        } else {
            // SMS sending failed
            return response()->json(['error' => 'SMS sending failed']);
        }
    }
    public function doctorPatient(Request $request)
    {
        // Start with the base query
        $patient = DB::table('patients')->orderBy('updated_at', 'desc');

        // Retrieve input parameters
        $name = $request->input('patient_name');
        $date = $request->input('patient_date');
        $page = $request->input('page_select', 5); // Set a default value for page if not provided

        // Apply filters
        if ($name) {
            $patient->where('name', 'like', "%{$name}%");
        }

        if ($date) {
            $patient->whereDate('updated_at', $date);
        }

        // Paginate the results
        $patient = $patient->paginate($page);

        // Append parameters to pagination links
        $patient->appends(['patient_name' => $name, 'patient_date' => $date, 'page_select' => $page]);

        // Pass data to the view
        return view('doctor.patient', compact('patient', 'name', 'date', 'page'));
    }

    public function patientInfo(Request $request)
    {
        $id = $request->id;
        $patient = Patient::where('id', $id)->first();
        return response()->json([
            'patient' => $patient
        ]);
    }
    public function getPatient(Request $request)
    {
        $id = $request->id;
        $patient = Patient::find($id);
        return response()->json([
            'patient' => $patient
        ]);
    }
    public function updatePatient(PatientRequest $request)
    {
        $id = $request->id;
        $newDiagnosis = $request->diagnosis;
        // Retrieve the patient
        $patient = Patient::find($id);
        $patient->name = $request->name;
        $patient->address = $request->address;
        $patient->phone = $request->phone;
        $patient->civil_status = $request->civil_status;
        $patient->sex = $request->sex;
        $patient->age = $request->age;
        $patient->birthday = $request->birthday;
        $patient->father_name = $request->father_name;
        $patient->father_occupation = $request->father_occupation;
        $patient->mother_name = $request->mother_name;
        $patient->mother_occupation = $request->mother_occupation;
        $patient->weight = $request->weight;
        $patient->height = $request->height;
        $patient->complaints = $request->complaints;
        $patient->treatment = $request->treatment;

        // Parse the existing JSON diagnosis into an array or use an empty array if null
        $currentDiagnosis = $patient->diagnosis ? json_decode($patient->diagnosis, true) : [];
        // Merge the new diagnosis data into the existing array
        $updatedDiagnosis = array_merge($currentDiagnosis, $newDiagnosis);
        // Encode the merged array back to JSON
        $patient->diagnosis = json_encode($updatedDiagnosis);
        // Save the updated patient
        $patient->save();

        return response()->json([
            'success' => 'Patient updated!',
        ]);
    }

    public function editSched(Request $request)
    {
        $id = $request->id;
        $sched = Schedule::where('id', $id)->first();
        return response()->json([
            'sched' => $sched
        ]);
    }
    public function updateSched(SchedRequest $request)
    {
        $id = $request->sched_id;
        $sched = Schedule::where('id', $id)->first();
        $sched->name = $request->name;
        $sched->date = $request->date;
        $sched->time = $request->time;
        $sched->save();
        return response()->json([
            'success' => 'Schedule updated!'
        ]);
    }
    public function deleteSched(Request $request)
    {
        $id = $request->sched_id;
        $sched = Schedule::where('id', $id)->first();
        $sched->delete();
        return response()->json([
            'error' => 'Schedule deleted!'
        ]);
    }
}
