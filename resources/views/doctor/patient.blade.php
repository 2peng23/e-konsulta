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
                <h5>Treatment</h5>
                <div id="diagnosis-data" class="table-responsive" style="max-height: 150px;">

                </div>
            </div>

        </div>
    </div>
    <x-edit-patient />
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
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
                            "July", "August", "September", "October", "November", "December"
                        ];

                        // Get month, day, and year
                        var month = monthNames[birthdayDate.getMonth()];
                        var day = birthdayDate.getDate();
                        var year = birthdayDate.getFullYear();

                        // Format the date
                        var formattedDate = month + ' ' + (day < 10 ? '0' : '') + day + ', ' +
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
                            (hours < 10 ? '0' : '') + hours + ':' + (minutes < 10 ? '0' : '') +
                            minutes + ampm;


                        $('#name').html('Name: ' + data.name);
                        $('#address').html('Address: ' + data.address);
                        $('#birthday').html('Birthday: ' + formattedDate);
                        $('#age').html('Age: ' + data.age);
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

                        diagnosisArray.forEach(function(element) {
                            var pTag = $('<p>').text(element);
                            container.append(pTag);
                        });

                    }

                })
            })
            $('.edit-btn').on('click', function() {
                var id = $(this).val();
                $('#id').val(id);
                $('#edit-patient').modal('show');
            })
        })
    </script>
@endsection
