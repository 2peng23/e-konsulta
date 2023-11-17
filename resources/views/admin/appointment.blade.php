@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <input type="text" value="{{ $name }}" class="form-control" placeholder="Search name" name="appoint_name"
                id="appoint_name">
        </div>
        <div>
            <input type="text" value="{{ $date }}" name="appoint_date" id="appoint_date" class="form-control">
        </div>
    </div>
    <div class="data">
        @if ($appointment->isEmpty())
            <p class="mt-5 text-danger">No data found</p>
        @else
            <select class="rounded mt-5 p-1" name="page_select" id="page_select">
                <option value="5" {{ $page == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $page == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ $page == 20 ? 'selected' : '' }}>20</option>
            </select>
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead class="bg-secondary text-white">
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
                        @foreach ($appointment as $item)
                            <tr class="text-center">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y l') }}</td>
                                <td>{{ $item->time }}</td>
                                <td>{{ $item->doctor }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $appointment->links('vendor.pagination.bootstrap-5') }}
        @endif
    </div>

@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(document).ready(function() {

            // search by name
            $(document).on('keyup', '#appoint_name', function() {
                var appointment_name = $(this).val();
                $.ajax({
                    url: "{{ route('appointment') }}",
                    data: {
                        appointment_name: appointment_name
                    },
                    type: "get",
                    success: function(res) {
                        $('.data').html($(res).find('.data').html())
                    }
                })
            })
            // search by date
            $(document).on('change', '#appoint_date', function() {
                var appointment_date = $(this).val();
                console.log(appointment_date);
                $.ajax({
                    url: "{{ route('appointment') }}",
                    data: {
                        appointment_date: appointment_date
                    },
                    type: "get",
                    success: function(res) {
                        $('.data').html($(res).find('.data').html())
                    }
                })
            })
        })
        // date
        $('input[name="appoint_date"]').daterangepicker({
            opens: 'left'
        });

        $('input[name="appoint_date"]').on('apply.daterangepicker', function(ev, picker) {});
        // page
        $(document).on('change', '#page_select', function() {
            var page_select = $(this).val();
            console.log(page_select);
            $.ajax({
                url: "{{ route('appointment') }}",
                data: {
                    page_select: page_select
                },
                type: "get",
                success: function(res) {
                    $('.data').html($(res).find('.data').html())
                }
            })
        })
    </script>
@endsection
