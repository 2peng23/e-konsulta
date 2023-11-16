@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <input type="text" value="{{ $name }}" class="form-control" placeholder="Search name" name="patient_name"
                id="patient_name">
        </div>
        <div>
            <input type="date" value="{{ $page }}" name="patient_date" id="patient_date" class="form-control">
        </div>
    </div>
    <div class="data">
        @if ($patient->isEmpty())
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
                            <th>Adress</th>
                            <th>Phone</th>
                            <th>Birthday</th>
                            <th>Age</th>
                            <th>Civil Status</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patient as $item)
                            <tr class="text-center">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->address }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->format('F d, Y ') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->birthday)->age }}</td>
                                <td>{{ $item->civil_status }}</td>
                                <td>active</td>
                                <td>
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

@endsection
@section('scripts')
    <script>
        // search by name
        $(document).on('keyup', '#patient_name', function() {
            var patient_name = $(this).val();
            $.ajax({
                url: "{{ route('patient') }}",
                data: {
                    patient_name: patient_name
                },
                type: "get",
                success: function(res) {
                    $('.data').html($(res).find('.data').html())
                }
            })
        })
        // search by date
        $(document).on('change', '#patient_date', function() {
            var patient_date = $(this).val();
            console.log(patient_date);
            $.ajax({
                url: "{{ route('patient') }}",
                data: {
                    patient_date: patient_date
                },
                type: "get",
                success: function(res) {
                    $('.data').html($(res).find('.data').html())
                }
            })
        })
        // page
        $(document).on('change', '#page_select', function() {
            var page_select = $(this).val();
            console.log(page_select);
            $.ajax({
                url: "{{ route('patient') }}",
                data: {
                    page_select: page_select
                },
                type: "get",
                success: function(res) {
                    $('.data').html($(res).find('.data').html())
                }
            })
        })
        $(document).on('click', '.info-btn', function() {
            var id = $(this).val();
            $('#info-canvas').offcanvas('show');
            $.ajax({
                url: '/info-patient',
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

                    // Filter out null values from the array
                    diagnosisArray = diagnosisArray.filter(function(element) {
                        return element !== null;
                    });

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
    </script>
@endsection
