<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

        if (!$doctor) {
            return response()->json([
                'error' => 'Doctor not found!'
            ], 404);
        }

        $doctor->name = $request->name;
        $doctor->expertise = $request->expertise;
        $existing_image = $doctor->image;

        // image
        $photo = $request->image;

        if ($photo) {
            // Remove existing image
            if ($existing_image) {
                $this->removeImage('images', $existing_image);
            }

            $photoname = $photo->getClientOriginalName();
            $request->image->move('images', $photoname);
            $doctor->image = $photoname;
        }

        $doctor->save();

        return response()->json([
            'success' => 'Doctor updated successfully!'
        ]);
    }
    // image remover
    protected function removeImage($directory, $filename)
    {
        $path = public_path($directory . '/' . $filename);

        // Check if the file exists before attempting to delete it
        if (File::exists($path)) {
            // Delete the file
            File::delete($path);
        }
    }
    public function deleteDoctor(Request $request)
    {
        $id = $request->id;
        $doctor = Doctor::find($id);
        $existing_image = $doctor->image;
        $this->removeImage('images', $existing_image);
        $doctor->delete();
        return response()->json([
            'error' => 'Deleted!'
        ]);
    }

    public function account()
    {
        $user = User::where('usertype', '!=', 0)->where('id', '!=', Auth::user()->id)->get();
        $doctor = Doctor::all();
        return view('admin.account', compact('doctor', 'user'));
    }
    public function addAccount(Request $request)
    {
        $existing_email = User::where('email', $request->email)->first();
        $existing_name = User::where('name', $request->name)->first();
        if ($existing_email || $existing_name) {
            return response()->json([
                'error' => 'Account already exist!'
            ]);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->usertype = $request->usertype;
        $user->save();
        return response()->json([
            'success' => 'Account created successfully!'
        ]);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return response()->json([
            'user' => $user
        ]);
    }
}
