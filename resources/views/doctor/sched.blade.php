@extends('layouts.doctor')
@section('content')
    <div class="d-flex justify-content-end ">
        <button class="btn btn-primary add-btn">
            <i class="fa fa-calendar-plus"></i>
        </button>
    </div>
    <x-add-sched />
    <x-ajax-message />
    @php
        $sched = App\Models\Schedule::where('name', Auth::user()->name)->get();
    @endphp
    <div id="data">
        @if ($sched->isEmpty())
            <p>No schedule available.</p>
        @else
            <div class="table-responsive mt-3">
                <table class="table table-bordered ">
                    <thead>
                        <tr class="text-center">
                            <th>Date</th>
                            <th>Timeslot(s)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sched as $item)
                            <tr class="text-center">
                                <td>{{ \Carbon\Carbon::parse($item->date)->format('F j, Y l') }}</td>
                                <td>
                                    @foreach ($item->time as $time)
                                        {{ $time }},
                                    @endforeach
                                </td>
                                <td>
                                    <button value="{{ $item->id }}" class="bn632-hover bn26 edit-btn"><i
                                            class="fa fa-pencil"></i></button>
                                    <button value="{{ $item->id }}" class="bn632-hover bn27 delete-btn"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <x-edit-sched />

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            toggleButtons();
            // edit-sched
            function toggleButtons() {
                $('.edit-btn').on('click', function() {
                    var id = $(this).val();
                    $('#edit-modal').modal('show');
                    $.ajax({
                        url: '{{ route('edit-sched') }}',
                        data: {
                            id: id
                        },
                        type: 'get',
                        success: function(res) {
                            console.log(res);
                            $('#edit-date').val(res.sched.date);
                            $('#sched_id').val(id);
                        }
                    })
                })
                $('.delete-btn').on('click', function() {
                    var sched_id = $(this).val();
                    if (confirm('Delte this schedule?')) {
                        $.ajax({
                            url: "{{ route('delete-sched') }}",
                            data: {
                                sched_id: sched_id
                            },
                            method: 'GET',
                            success: function(result) {
                                console.log(result);
                                $("#error-modal").modal("show");
                                $("#error-message").html(result.error);
                                $('#data').load(window.location.href + ' #data', function() {
                                    toggleButtons();
                                })
                                // If you want to hide a success message after 1.5 seconds, uncomment the following lines
                                setTimeout(function() {
                                    $("#error-modal").modal("hide");
                                }, 2000);
                            }
                        })
                    }
                })
                // add doctor
                $(".add-btn").on("click", function() {
                    console.log("Hello");
                    $("#add-sched").modal("show");
                });

            }


            $("#add-sched-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('add-sched') }}",
                    data: new FormData(this),
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        if (result.success) {
                            $("#add-sched-form")[0].reset();
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#add-sched").modal("hide");
                            $("#data").load(
                                window.location.href + " #data",
                                function() {
                                    toggleButtons();
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
                    },
                    error: function(xhr, status, error) {
                        // If you want to handle errors and display error messages, uncomment the following lines
                        var errors = xhr.responseJSON.errors;
                        var errorString = "";
                        $.each(errors, function(key, value) {
                            errorString += value + "<br>";
                        });
                        $("#error-modal").modal("show");
                        $("#error-message").html(errorString);
                        setTimeout(function() {
                            $("#error-modal").modal("hide");
                        }, 2000);
                    },
                });
            });


            // update sched
            $('#update-sched').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('update-sched') }}",
                    data: new FormData(this),
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        if (result.success) {
                            $("#update-sched")[0].reset();
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#edit-modal").modal("hide");
                            $("#data").load(
                                window.location.href + " #data",
                                function() {
                                    toggleButtons();
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
                    },
                    error: function(xhr, status, error) {
                        // If you want to handle errors and display error messages, uncomment the following lines
                        var errors = xhr.responseJSON.errors;
                        var errorString = "";
                        $.each(errors, function(key, value) {
                            errorString += value + "<br>";
                        });
                        $("#error-modal").modal("show");
                        $("#error-message").html(errorString);
                        setTimeout(function() {
                            $("#error-modal").modal("hide");
                        }, 2000);
                    },
                });
            })

        })
    </script>
@endsection
