<?php

use App\Http\Controllers\AdminControler;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $doctor = Doctor::all();
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('default.home', compact('doctor'));
});

Route::get('dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::get('doctor', [AdminControler::class, 'doctor'])->name('doctor');
        Route::get('staff', [AdminControler::class, 'staff'])->name('staff');
        Route::get('patient', [AdminControler::class, 'patient'])->name('patient');
        Route::get('appointment', [AdminControler::class, 'appointment'])->name('appointment');
        Route::get('report', [AdminControler::class, 'report'])->name('report');
        Route::post('add-doctor', [AdminControler::class, 'addDoctor'])->name('add-doctor');
        Route::get('edit-doctor/{id}', [AdminControler::class, 'editDoctor'])->name('edit-doctor');
        Route::post('update-doctor', [AdminControler::class, 'updateDoctor'])->name('update-doctor');
        Route::get('delete-doctor', [AdminControler::class, 'deleteDoctor'])->name('delete-doctor');
        Route::get('account', [AdminControler::class, 'account'])->name('account');
        Route::post('add-account', [AdminControler::class, 'addAccount'])->name('add-account');
        Route::get('edit-user/{id}', [AdminControler::class, 'editUser'])->name('edit-user');
    });

    Route::middleware('user')->group(function () {
        Route::get('make-appointment/{id}/{name}', [UserController::class, 'makeAppointment'])->name('make-appointment');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
