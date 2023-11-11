@extends('layouts.user')

@section('content')
    {{-- @include('default.appointment', compact('doctor')) --}}
    <!-- Start Appointment -->
    <x-ajax-message />
    <section class="appointment">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Hey there! I'm Dr. <span>{{ $doctor->name }}</span> <i
                                class="fa fa-stethoscope text-primary"></i>
                        </h2>
                        <img src="user/img/section-img.png" alt="#">
                        <p> Dedicated to providing compassionate care and expertise
                            in my field which is <span class="text-primary">{{ $doctor->expertise }}</span> </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <form class="form" action="{{ route('create-appointment') }}" id="create-appointment" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="name" type="text" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="email" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <input name="phone" type="text" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    @php
                                        $sched = \App\Models\Schedule::where('name', $doctor->name)->get();

                                    @endphp
                                    <select name="date" id="date-select" class="form-select">
                                        @foreach ($sched as $item)
                                            <option value="{{ $item->date }}">
                                                {{ \Carbon\Carbon::parse($item->date)->format('F j, Y l') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group" id="time-select">
                                    <select name="time" class="form-select">
                                        <option selected>Select Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <textarea name="message" id="message-area" placeholder="Write Your Message Here....."></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="doctor" id="doctor-name" value="{{ $doctor->name }}" hidden>
                        <div class="row">
                            <div class="col-lg-5 col-md-4 col-12">
                                <div class="form-group">
                                    <div class="button">
                                        <button type="submit" class="btn">Book An Appointment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="appointment-image">
                        <img src="images/{{ $doctor->image }}" alt="#" style="max-height: 515px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Appointment -->
@endsection
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Attach the change event handler to the select element
        $('#date-select').change(function() {
            // Get the selected value
            var date = $(this).val();
            var doctor = $('#doctor-name').val();
            // Make the Ajax request inside the change event handler
            $.ajax({
                url: "{{ route('getTime') }}",
                data: {
                    date: date,
                    doctor: doctor
                },
                type: 'get',
                dataType: 'json', // Specify that the expected response is JSON
                success: function(res) {
                    console.log(res.output);
                    $('#time-select').html(res.output);
                },
                error: function(err) {
                    console.error(err);
                }
            });

        });

        // submit form
        $('#create-appointment').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('create-appointment') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result.success);
                    // console.log(result);
                    if (result.success) {
                        $("#create-appointment")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
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
            })
        })
    });
</script>
