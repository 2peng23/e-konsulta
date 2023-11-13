@extends('layouts.doctor')
@section('content')
    <div class="d-flex justify-content-between my-3">
        <div>
            <input type="text" class="form-control" placeholder="Search name">
        </div>
        <div>
            <input type="date" class="form-control">
        </div>
    </div>
    @php
        $patient = App\Models\Patient::paginate(5);
    @endphp
    <div class="data mt-5">
        @if ($patient->isEmpty())
            <p>No data found.</p>
        @else
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center bg-secondary text-white">
                            <th></th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient as $item)
                            <tr class="text-center">
                                <td><i class="fa fa-angle-right"></i></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sex }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->age }}</td>
                                <td>
                                    <button value="{{ $item->id }}" class="bn632-hover bn26 edit-btn"><i
                                            class="fa fa-pencil"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
