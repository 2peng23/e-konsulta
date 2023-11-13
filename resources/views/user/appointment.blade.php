@extends('layouts.user')
@section('content')
    @php
        $appointment = App\Models\Appointment::whereUserId(Auth::user()->id)->get();

    @endphp
    <div class="data">
        @if ($appointment->isEmpty())
            <h6 class="my-5 container">No appointment available.</>
            @else
                <div class="container my-5">
                    <h5 class="my-2">My Appointment</h5>
                    <div class="table-responsive ">
                        <table class="table table-bordered ">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Doctor</th>
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
                                        <td>Dr. {{ $item->doctor }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <p class="text-warning">{{ $item->status }}</p>
                                            @elseif($item->status == 'approved')
                                                <p class="text-success">{{ $item->status }}</p>
                                            @elseif($item->status == 'declined')
                                                <p class="text-danger">{{ $item->status }}</p>
                                            @elseif($item->status == 'cancelled')
                                                <p class="text-warning">{{ $item->status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $existing = App\Models\Patient::whereName($item->name)->first();
                                            @endphp
                                            @if ($item->status == 'pending')
                                                <button value="{{ $item->id }}" class="bn632-hover bn27 cancel-btn">
                                                    cancel
                                                </button>
                                            @elseif($item->status == 'declined')
                                                <p>declined</p>
                                            @elseif($item->status == 'cancelled')
                                                <p>cancelled</p>
                                            @else
                                                @if ($existing)
                                                    <p>confirmed</p>
                                                @else
                                                    <button value="{{ $item->id }}"
                                                        class="bn632-hover bn26 proceed-btn">Proceed</button>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        @endif
    </div>
    <x-patient-form />
    <x-ajax-message />
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $(document).ready(function() {
            $('.proceed-btn').on('click', function() {
                var id = $(this).val();
                console.log(id);
                $('#patient-modal').modal("show");
            })
            $("#add-patient-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('add-patient') }}",
                    data: new FormData(this),
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        if (result.success) {
                            $("#add-patient-form")[0].reset();
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#patient-modal").modal("hide");
                            $(".data").load(
                                window.location.href + " .data"
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

            // cancel appointment
            $('.cancel-btn').on('click', function() {
                var id = $(this).val();
                $.ajax({
                    url: '/cancel-appointment/',
                    data: {
                        id: id
                    },
                    method: 'get',
                    success: function(result) {
                        console.log(result);
                        $("#error-modal").modal("show");
                        $("#error-message").html(result.error);
                        $(".data").load(
                            window.location.href + " .data"
                        );
                        setTimeout(function() {
                            $("#error-modal").modal("hide");
                        }, 2000);
                    }
                })
            })
        })
    </script>
@endsection
