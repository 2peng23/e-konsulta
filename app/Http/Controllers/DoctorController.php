<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchedRequest;
use App\Models\Appointment;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function doctorAppointment()
    {
        return view('doctor.appointment');
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
}
