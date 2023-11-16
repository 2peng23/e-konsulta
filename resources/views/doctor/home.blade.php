@extends('layouts.doctor')
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-calendar"></i>
                        Schedule
                    </div>
                    @php
                        $sched = App\Models\Schedule::where('name', Auth::user()->name)->count();
                    @endphp
                    <p>{{ $sched }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('doctor-schedule') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-file"></i>
                        Appointment
                    </div>
                    @php
                        $appoint = App\Models\Appointment::where('doctor', Auth::user()->name)->count();
                    @endphp
                    <p>{{ $appoint }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/doctor-appointment">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-user-md"></i>
                        Patient
                    </div>
                    @php
                        $patient = App\Models\Patient::count();
                    @endphp
                    <p>{{ $patient }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/doctor-patient">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>
@endsection
