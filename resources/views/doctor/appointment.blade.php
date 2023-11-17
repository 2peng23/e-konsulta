@extends('layouts.doctor')
@section('content')

    <x-ajax-message />
    <div class="d-flex justify-content-between ">
        <div>
            <input type="text" value="{{ $name }}" name="app_name" id="app_name" placeholder="Search patient"
                class="form-control">
        </div>
        <div>
            <input type="text" value="{{ $date }}" name="app_date" id="app_date" class="form-control">
        </div>
    </div>
    <div id="data">
        @if ($appointment->isEmpty())
            <p class="mt-5 text-danger">No appointment available.</p>
        @else
            <select class="rounded mt-5 mb-2 p-1" name="page_select" id="page_select">
                <option value="5" {{ $page == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $page == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ $page == 20 ? 'selected' : '' }}>20</option>
            </select>
            <div class="table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr class="text-center bg-secondary  text-white">
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Email</th>
                            <th>Phone</th>
                            {{-- <th>Message</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointment as $item)
                            <tr class="text-center">
                                <td>{{ $item->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('F j, Y l') }}</td>
                                <td>{{ $item->time }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                {{-- <td>{{ $item->message }}</td> --}}
                                <td>
                                    @if ($item->status == 'cancelled')
                                        <p class="text-warning">{{ $item->status }}</p>
                                    @elseif($item->status == 'declined')
                                        <p class="text-danger">{{ $item->status }}</p>
                                    @else
                                        <p class="text-success">{{ $item->status }}</p>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <button value="{{ $item->id }}" class="bn632-hover bn26 approve-btn"
                                            style="font-size: 14px"><i class="fa fa-thumbs-up"
                                                id="approve-icon"></i>approve</button>
                                        <button value="{{ $item->id }}" class="bn632-hover bn27 decline-btn"
                                            style="font-size: 14px"><i class="fa fa-thumbs-down"
                                                id="decline-icon"></i>decline</button>
                                    @elseif($item->status == 'cancelled')
                                        <p><i class="fa fa-exclamation-triangle  text-muted"></i></p>
                                    @elseif($item->status == 'declined')
                                        <p><i class="fa fa-thumbs-down text-muted"></i></p>
                                    @else
                                        <p><i class="fa fa-thumbs-up  text-muted"></i></p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $appointment->links('vendor.pagination.bootstrap-4') }}
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
            toggleAction();

            function toggleAction() {
                // approve
                $('.approve-btn').on('click', function() {
                    var id = $(this).val();
                    // Find the icon within the button
                    var icon = $(this).find("#approve-icon");
                    // Remove existing classes and add new classes
                    icon.removeClass("fa-thumbs-up").addClass("fa-spinner rotate");
                    console.log(id);
                    $.ajax({
                        url: "/approve/" + id,
                        data: {
                            id: id
                        },
                        type: "get",
                        success: function(result) {
                            if (result.success) {
                                $("#success-modal").modal("show");
                                $("#success-message").html(result.success);
                                // If you want to hide the modal after a successful submission, uncomment the following line
                                $("#data").load(
                                    window.location.href + " #data",
                                    function() {
                                        toggleAction();
                                    }
                                );
                            } else {
                                $("#error-modal").modal("show");
                                $("#error-message").html(result.error);
                            }
                            // If you want to hide a success message after 1.5 seconds, uncomment the following lines
                            setTimeout(function() {
                                $("#success-modal").modal("hide");
                                $("#error-modal").modal("hide");
                            }, 2000);
                        }
                    })
                })
                // decline
                $('.decline-btn').on('click', function() {
                    var id = $(this).val();
                    // Find the icon within the button
                    var icon = $(this).find("#decline-icon");
                    // Remove existing classes and add new classes
                    icon.removeClass("fa-thumbs-down").addClass("fa-spinner rotate");
                    console.log(id);
                    $.ajax({
                        url: "/decline/" + id,
                        data: {
                            id: id
                        },
                        type: "get",
                        success: function(result) {
                            if (result.success) {
                                $("#success-modal").modal("show");
                                $("#success-message").html(result.success);
                                // If you want to hide the modal after a successful submission, uncomment the following line
                                $("#data").load(
                                    window.location.href + " #data",
                                    function() {
                                        toggleAction();
                                    }
                                );
                            } else {
                                $("#error-modal").modal("show");
                                $("#error-message").html(result.error);
                            }
                            // If you want to hide a success message after 1.5 seconds, uncomment the following lines
                            setTimeout(function() {
                                $("#success-modal").modal("hide");
                                $("#error-modal").modal("hide");
                            }, 2000);
                        }
                    })
                })
            }

            $('#app_name').on('keyup', function() {
                var app_name = $(this).val();
                console.log(app_name);
                $.ajax({
                    url: '{{ route('doctor-appointment') }}',
                    data: {
                        app_name: app_name
                    },
                    method: 'get',
                    success: function(response) {
                        $('#data').html($(response).find('#data')
                            .html()); // Replace content of #table-data2
                        toggleAction();
                    }
                })
            })
            $('#app_date').on('change', function() {
                var app_date = $(this).val();
                console.log(app_date);
                $.ajax({
                    url: '{{ route('doctor-appointment') }}',
                    data: {
                        app_date: app_date
                    },
                    method: 'get',
                    success: function(response) {
                        $('#data').html($(response).find('#data')
                            .html()); // Replace content of #table-data2
                        toggleAction();
                    }
                })
            })
        })
        // page
        $(document).on('change', '#page_select', function() {
            var page_select = $(this).val();
            console.log(page_select);
            $.ajax({
                url: "{{ route('doctor-appointment') }}",
                data: {
                    page_select: page_select
                },
                type: "get",
                success: function(res) {
                    $('#data').html($(res).find('#data').html());
                    toggleAction();
                }
            })
        })
        // date
        $('input[name="app_date"]').daterangepicker({
            opens: 'left'
        });

        $('input[name="app_date"]').on('apply.daterangepicker', function(ev, picker) {});
    </script>
@endsection
