@extends('layouts.admin')
@section('content')
    <hr>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-calendar"></i>
                        Appointment
                    </div>
                    @php
                        $app = App\Models\Appointment::count();
                    @endphp
                    <p>{{ $app }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('appointment') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-users"></i>
                        Patients
                    </div>
                    @php
                        $patient = App\Models\Patient::count();
                    @endphp
                    <p>{{ $patient }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/patient">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-user-md"></i>
                        Doctor
                    </div>
                    <p>
                        @php
                            $doctor_count = App\Models\Doctor::count();
                        @endphp
                        {{ $doctor_count }}
                    </p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/doctor">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body d-flex justify-content-between ">
                    <div>
                        <i class="fa fa-user-circle"></i>
                        Account
                    </div>
                    @php
                        $account = App\Models\User::where('usertype', 2)->count();
                    @endphp
                    <p>{{ $account }}</p>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('account') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection
