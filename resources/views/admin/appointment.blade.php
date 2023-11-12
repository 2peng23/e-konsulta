@extends('layouts.admin')
@section('content')
    @php
        $appointment = App\Models\Appointment::paginate(5);
    @endphp
    <div class="d-flex justify-content-between">
        <div>
            <input type="text" class="form-control" placeholder="Search name" name="appoint_name" id="appoint_name">
        </div>
        <div>
            <input type="date" name="daterange" id="daterange" class="form-control">
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-center">
                    @foreach ($appointment as $item)
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->time }}</td>
                        <td>{{ $item->doctor }}</td>
                        <td>{{ $item->status }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
@endsection
