@extends('layouts.doctor')
@section('content')
    <div class="d-flex justify-content-between my-3">
        <div>
            <input type="text" value="{{ $name }}" name="patient_name" id="patient_name" class="form-control"
                placeholder="Search name">
        </div>
        <div>
            <input type="date" value="{{ $date }}" name="patient_date" id="patient_date" class="form-control">
        </div>
    </div>
    <div class="data mt-5">
        @if ($patient->isEmpty())
            <p class="text-danger">No data found.</p>
        @else
            <select class="rounded mb-1 p-1" name="page_select" id="page_select">
                <option value="5" {{ $page == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $page == 10 ? 'selected' : '' }}>10</option>
                <option value="15" {{ $page == 15 ? 'selected' : '' }}>15</option>
                <option value="20" {{ $page == 20 ? 'selected' : '' }}>20</option>
            </select>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center bg-secondary text-white">
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
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->sex }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->format('F d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->age }}</td>
                                <td>
                                    <button value="{{ $item->id }}" class="bn632-hover bn26 edit-btn"><i
                                            class="fa fa-pencil"></i></button>
                                    <button value="{{ $item->id }}" class="bn632-hover bn26 info-btn"><i
                                            class="fa fa-info"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $patient->links('vendor.pagination.bootstrap-5') }}
        @endif
    </div>
    <div class="offcanvas offcanvas-end rounded" style="border-left: 3px solid blue" tabindex="-1" id="info-canvas"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Patient Information</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <p id="name"></p>
            <p id="address"></p>
            <div class="row">
                <p class="col-4" id="civil_status"></p>
                <p class="col-4" id="age"></p>
                <p class="col-4" id="sex"></p>
            </div>
            <p id="birthday"></p>
            <p id="height"></p>
            <p id="weight"></p>
            <p id="father_name"></p>
            <p id="mother_name"></p>
            <p id="updated_at"></p>
            <div class="table-responsive">
                <h5>Previous Diagnosis</h5>
                <div id="diagnosis-data" class="table-responsive" style="max-height: 220px;">

                </div>
            </div>

        </div>
    </div>
    <x-edit-patient />
    <x-ajax-message />
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            toggleAction();

            function toggleAction() {
                $('.info-btn').on('click', function() {
                    var id = $(this).val();
                    $('#info-canvas').offcanvas('show');
                    $.ajax({
                        url: '/patient-info',
                        data: {
                            id: id
                        },
                        method: 'get',
                        success: function(res) {
                            var data = res.patient;
                            // Assuming data.birthday is a valid date string like '2020-06-05'
                            var birthdayDate = new Date(data.birthday);

                            // Array of month names
                            var monthNames = [
                                "January", "February", "March", "April", "May", "June",
                                "July", "August", "September", "October", "November",
                                "December"
                            ];

                            // Get month, day, and year
                            var month = monthNames[birthdayDate.getMonth()];
                            var day = birthdayDate.getDate();
                            var year = birthdayDate.getFullYear();

                            // Format the date
                            var formattedDate = month + ' ' + (day < 10 ? '0' : '') + day +
                                ', ' +
                                year;
                            var updatedAtDate = new Date(data.updated_at);
                            // Get month, day, year, hours, and minutes
                            var month = monthNames[updatedAtDate.getMonth()];
                            var day = updatedAtDate.getDate();
                            var year = updatedAtDate.getFullYear();
                            var hours = updatedAtDate.getHours();
                            var minutes = updatedAtDate.getMinutes();
                            // AM/PM
                            var ampm = hours >= 12 ? 'pm' : 'am';
                            hours = hours % 12;
                            hours = hours ? hours : 12; // the hour '0' should be '12'

                            // Format the date and time
                            var formattedUpdatedAt = month + ' ' + (day < 10 ? '0' : '') + day +
                                ', ' + year + ' ' +
                                (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' :
                                    '') +
                                minutes + ampm;

                            // Assuming formattedDate is a Date object representing the birthday
                            var birthday = new Date(formattedDate);
                            var today = new Date();

                            var age = today.getFullYear() - birthday.getFullYear();

                            // Check if the birthday has occurred this year
                            if (today.getMonth() < birthday.getMonth() || (today.getMonth() ===
                                    birthday.getMonth() && today.getDate() < birthday.getDate()
                                )) {
                                age--;
                            }


                            $('#name').html('Name: ' + data.name);
                            $('#address').html('Address: ' + data.address);
                            $('#birthday').html('Birthday: ' + formattedDate);
                            $('#age').html('Age: ' + age);
                            $('#sex').html('Sex: ' + data.sex);
                            $('#civil_status').html('Status: ' + data.civil_status);
                            $('#height').html('Height: ' + data.height);
                            $('#weight').html('Weight: ' + data.weight);
                            $('#father_name').html('Father: ' + data.father_name + ',' + data
                                .father_occupation);
                            $('#mother_name').html('Mother: ' + data.mother_name + ',' + data
                                .mother_occupation);
                            $('#updated_at').html('Last visit: ' + formattedUpdatedAt);
                            var diagnosis = data.diagnosis;
                            var diagnosisArray = JSON.parse(diagnosis);
                            var container = $('#diagnosis-data');

                            // Reverse the array to display from last index to 0
                            diagnosisArray.reverse();

                            diagnosisArray.forEach(function(element) {
                                var pTag = $(
                                        '<p style="border-bottom: 1px solid black">')
                                    .text(element);
                                container.append(pTag);
                            });
                            $('#info-canvas').on('hidden.bs.offcanvas', function() {
                                // Reset data when the offcanvas is hidden
                                resetInfoCanvas();
                            });


                        }

                    })
                })
                $('.edit-btn').on('click', function() {
                    var id = $(this).val();
                    $('#id').val(id);
                    $('#edit-patient').modal('show');
                    $.ajax({
                        url: "{{ route('get-patient') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            var patient = res.patient;
                            console.log(patient);
                            $('#edit-name').val(patient.name);
                            $('#edit-address').val(patient.address);
                            $('#edit-phone').val(patient.phone);
                            $('#edit-civil_status').val(patient.civil_status);
                            $('#edit-sex').val(patient.sex);
                            $('#edit-age').val(patient.age);
                            $('#edit-birthday').val(patient.birthday);
                            $('#edit-father_name').val(patient.father_name);
                            $('#edit-father_occupation').val(patient.father_occupation);
                            $('#edit-mother_name').val(patient.mother_name);
                            $('#edit-mother_occupation').val(patient.mother_occupation);
                            $('#edit-weight').val(patient.weight);
                            $('#edit-height').val(patient.height);
                        }
                    })
                    $('#update-patient-form').on('submit', function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "{{ route('update-patient') }}",
                            data: new FormData(this),
                            method: "POST",
                            processData: false,
                            contentType: false,
                            success: function(result) {
                                console.log(result);
                                if (result.success) {
                                    $("#update-patient-form")[0].reset();
                                    $("#success-modal").modal("show");
                                    $("#success-message").html(result.success);
                                    // If you want to hide the modal after a successful submission, uncomment the following line
                                    $("#edit-patient").modal("hide");
                                    $(".data").load(
                                        window.location.href + " .data",
                                        function() {
                                            toggleAction();
                                            togglePage();
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
                                console.log(error);
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
                // form nex=prev
                $('.next-btn').on('click', function(e) {
                    e.preventDefault()
                    $('.page-1').hide();
                    $('.page-2').fadeIn();
                })
                $('.prev-btn').on('click', function(e) {
                    e.preventDefault()
                    $('.page-2').hide();
                    $('.page-1').fadeIn();
                })

            }

            function resetInfoCanvas() {
                // Reset the content of elements inside the info-canvas here
                $('#name').html('');
                $('#address').html('');
                $('#birthday').html('');
                $('#age').html('');
                $('#sex').html('');
                $('#civil_status').html('');
                $('#height').html('');
                $('#weight').html('');
                $('#father_name').html('');
                $('#mother_name').html('');
                $('#updated_at').html('');
                $('#diagnosis-data').empty(); // Empty the container for diagnosis data
            }
            togglePage();

            function togglePage() {
                // page
                $('#page_select').on('change', function() {
                    var page_select = $(this).val();
                    console.log(page_select);
                    $.ajax({
                        url: "{{ route('doctor-patient') }}",
                        method: 'get',
                        data: {
                            page_select: page_select
                        },
                        success: function(response) {
                            $('.data').html($(response).find('.data')
                                .html()); // Replace content of #table-data2
                            togglePage();
                            toggleAction();
                        }
                    })
                })
                // name
                $('#patient_name').on('keyup', function() {
                    var patient_name = $(this).val();
                    $.ajax({
                        url: "{{ route('doctor-patient') }}",
                        method: 'get',
                        data: {
                            patient_name: patient_name
                        },
                        success: function(response) {
                            $('.data').html($(response).find('.data')
                                .html()); // Replace content of #table-data2
                            togglePage();
                            toggleAction();
                        }
                    })
                })
                // date
                $('#patient_date').on('change', function() {
                    var patient_date = $(this).val();
                    console.log(patient_date);
                    $.ajax({
                        url: "{{ route('doctor-patient') }}",
                        data: {
                            patient_date: patient_date
                        },
                        method: 'get',
                        success: function(response) {
                            $('.data').html($(response).find('.data')
                                .html()); // Replace content of .table
                            togglePage();
                            toggleAction();
                        }
                    })
                })
            }
        })
    </script>
@endsection
