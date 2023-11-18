<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Package;
use App\Models\Patient;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminControler extends Controller
{
    public function doctor()
    {
        $doctor = Doctor::all();
        return view('admin.doctor', compact('doctor'));
    }
    public function package()
    {
        return view('admin.package');
    }
    public function patient(Request $request)
    {
        $patient = DB::table('patients')->orderBy('updated_at', 'desc');
        // Retrieve input parameters
        $name = $request->input('patient_name');
        $date = $request->input('patient_date');
        $page = $request->input('page_select', 5); // Set a default value for page if not provided
        // Apply filters
        if ($name) {
            $patient->where('name', 'like', "%{$name}%");
        }

        // Search by Date Range
        if ($date) {
            $dateArray = explode(' - ', $date);
            $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', $dateArray[0])->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', $dateArray[1])->endOfDay();
            $patient = $patient->whereBetween('created_at', [$start_date, $end_date]);
        }
        // Paginate the results
        $patient = $patient->paginate($page);

        // Append parameters to pagination links
        $patient->appends(['patient_name' => $name, 'patient_date' => $date, 'page_select' => $page]);
        return view('admin.patient', compact('patient', 'name', 'date', 'page'));
    }
    public function appointment(Request $request)
    {
        $appointment = DB::table('appointments')->orderBy('updated_at', 'desc');
        // Retrieve input parameters
        $name = $request->input('appointment_name');
        $date = $request->input('appointment_date');
        $page = $request->input('page_select', 5); // Set a default value for page if not provided
        // Apply filters
        if ($name) {
            $appointment->where('name', 'like', "%{$name}%");
        }

        // Search by Date Range
        if ($date) {
            $dateArray = explode(' - ', $date);
            $start_date = \Carbon\Carbon::createFromFormat('m/d/Y', $dateArray[0])->startOfDay();
            $end_date = \Carbon\Carbon::createFromFormat('m/d/Y', $dateArray[1])->endOfDay();
            $appointment = $appointment->whereBetween('created_at', [$start_date, $end_date]);
        }
        // Paginate the results
        $appointment = $appointment->paginate($page);

        // Append parameters to pagination links
        $appointment->appends(['appointment_name' => $name, 'appointment_date' => $date, 'page_select' => $page]);
        return view('admin.appointment', compact('appointment', 'name', 'date', 'page'));
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

        if ($doctor) {
            // change the user doctor name
            $user = User::where('name', $doctor->name)->first();

            if ($user) {
                $user->name = $request->name;
                $user->save();
            }
            // change the appointment doctor
            $appointment = Appointment::where('doctor', $doctor->name)->get();
            if ($appointment) {
                foreach ($appointment as $app) {
                    $app->doctor = $request->name;
                    $app->save();
                }
            }
            // change the schedule
            $schedule = Schedule::whereName($doctor->name)->get();
            if ($schedule) {
                foreach ($schedule as $sched) {
                    $sched->name = $request->name;
                    $sched->save();
                }
            }
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
    public function updateAccount(Request $request)
    {
        $request->validate([
            'password' => 'min:8',
        ]);
        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->usertype = $request->usertype;
        $user->save();
        return response()->json([
            'success' => 'Account updated!'
        ]);
    }
    public function deleteAccount(Request $request)
    {
        $id = $request->admin_id;
        $user = User::find($id);
        // Check if the user with the given ID exists 
        // if (!$user) {
        //     return response()->json([
        //         'error' => 'User not found!'
        //     ]);
        // }

        $adminPassword = $request->admin_password;

        // Use Hash::check() to compare hashed passwords
        if (Hash::check($adminPassword, Auth::user()->password)) {
            // Check if the authenticated user is an admin and authorized

            if (Auth::user()->usertype == 1) {
                $user->delete();

                return response()->json([
                    'success' => 'Account deleted!'
                ]);
            } else {
                return response()->json([
                    'error' => 'Unauthorized to delete account!'
                ]);
            }
        } else {
            return response()->json([
                'error' => 'Password error!'
            ]);
        }
    }
    public function infoPatient(Request $request)
    {
        $id = $request->id;
        $patient = Patient::find($id);
        return response()->json([
            'patient' => $patient
        ]);
    }
    public function addPackage(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'inclusion' => 'required',
        ]);
        $existing = Package::whereName($request->name)->first();
        if ($existing) {
            return response()->json([
                'error' => "Package already exist!"
            ]);
        }
        $package = new Package();
        $package->name = $request->name;
        $package->price = $request->price;
        $package->inclusion = $request->inclusion;
        $package->save();
        return response()->json([
            'success' => 'Package added!'
        ]);
    }

    public function deleteInclusion(Request $request)
    {
        $id = $request->id;
        $index = $request->index;

        $package = Package::find($id);

        $inclusions = $package->inclusion;


        // Delete the inclusion at the specified index
        unset($inclusions[$index]);

        // Reindex the array to maintain consecutive keys
        $inclusions = array_values($inclusions);

        // Update the package with the modified inclusions
        $package->update(['inclusion' => $inclusions]);

        return response()->json(['error' => 'Deleted']);
    }
    public function addInclusion(Request $request)
    {
        $id = $request->inc_id;
        $package = Package::find($id);

        // Get the existing inclusions array
        $existingInclusions = $package->inclusion;

        // Get the new inclusion from the request
        $newInclusion = $request->new_inclusion;

        // Check if the new inclusion already exists to avoid duplicates
        if (!in_array($newInclusion, $existingInclusions)) {
            // Add the new inclusion to the existing inclusions array
            $existingInclusions[] = $newInclusion;

            // Update the package with the modified inclusions array
            $package->update(['inclusion' => $existingInclusions]);

            // You may also save the package if needed, although update already saves changes
            // $package->save();

            // Return a response or perform any other actions as needed
            return response()->json(['success' => 'Inclusion added!']);
        } else {
            // Return a response indicating that the inclusion already exists
            return response()->json(['error' => 'Inclusion already exists!']);
        }
    }
    public function deletePackage(Request $request)
    {
        $id = $request->admin_id;
        $password = $request->admin_password;
        $package = Package::find($id);

        $match = Hash::check($password, Auth::user()->password);
        if ($match) {
            $package->delete();
            return response()->json([
                'success' => 'Package deleted!'
            ]);
        } else {
            return response()->json([
                'error' => 'Incorrect password!'
            ]);
        }
    }
    public function getPackage(Request $request)
    {
        $id = $request->id;
        $package = Package::find($id);
        return response()->json([
            'package' => $package
        ]);
    }
    public function updatePackage(Request $request)
    {
        $id = $request->update_id;
        $name = $request->edit_name;
        $price = $request->edit_price;
        $package = Package::find($id);
        $package->name = $name;
        $package->price = $price;
        $package->save();
        return response()->json([
            'success' => "Package Updated!"
        ]);
    }
}
