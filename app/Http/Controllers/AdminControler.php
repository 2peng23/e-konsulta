<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AdminControler extends Controller
{
    public function doctor()
    {
        $doctor = Doctor::all();
        return view('admin.doctor', compact('doctor'));
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
    public function addDoctor(DoctorRequest $request)
    {
        $doctor = Doctor::where('name', $request->name)->first();
        if ($doctor) {
            return response()->json([
                'error' => 'Doctor already exist!'
            ]);
        }
        $data = new Doctor();
        $data->name = $request->name;
        $data->expertise = $request->expertise;

        // image
        $photo = $request->image;
        $photoname = $photo->getClientOriginalName();
        $request->image->move('images', $photoname);
        $data->image = $photoname;
        $data->save();
        return response()->json([
            'success' => 'Doctor added successfully!'
        ]);
    }
    public function editDoctor($id)
    {
        $doctor = Doctor::find($id);
        return response()->json([
            'doctor' => $doctor
        ]);
    }
    public function updateDoctor(Request $request)
    {
        $item_id = $request->item_id;
        $doctor = Doctor::find($item_id);
        $doctor->name = $request->name;
        $doctor->expertise = $request->expertise;
        // image
        $photo = $request->image;
        if ($photo) {
            $photoname = $photo->getClientOriginalName();
            $request->image->move('images', $photoname);
            $doctor->image = $photoname;
        }
        $doctor->save();
        return response()->json([
            'success' => 'Doctor updated successfully!'
        ]);
    }
    public function deleteDoctor(Request $request)
    {
        $id = $request->id;
        $doctor = Doctor::find($id);
        $doctor->delete();
        return response()->json([
            'error' => 'Deleted!'
        ]);
    }
}
