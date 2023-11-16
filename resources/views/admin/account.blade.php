@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-end ">
        <button class="btn btn-primary add-btn">
            <i class="fa fa-user-plus"></i>
        </button>
    </div>
    <x-add-account :doctor=$doctor />
    <x-create-account />
    <x-ajax-message />
    <x-edit-account :doctor=$doctor />
    <x-admin-password />

    <div id="dataa">
        @if ($user->isEmpty())
            <p>No Accounts available.</p>
        @else
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr class="text-center">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->usertype == 1)
                                        Admin
                                    @elseif($item->usertype == 2)
                                        Doctor
                                    @else
                                        Staff
                                    @endif
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
@endsection

@section('scripts')
    <script>
        // add account
        $(".add-btn").on("click", function() {
            $("#create-modal").modal("show");
        });
        $(".btn-doctor").on("click", function() {
            $("#add-doctor-modal").modal("show");
            $("#create-modal").modal("hide");

        });
        $(".btn-staff").on("click", function() {
            $("#add-staff-modal").modal("show");
            $("#create-modal").modal("hide");

        });
        $(".btn-admin").on("click", function() {
            $("#add-admin-modal").modal("show");
            $("#create-modal").modal("hide");

        });
        // add doctor account
        $("#add-doctor-account").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('add-account') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#add-doctor-account")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#add-doctor-modal").modal("hide");
                        $("#dataa").load(window.location.href + " #dataa");
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
        // add staff account
        $("#add-staff-account").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('add-account') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#add-staff-account")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#add-staff-modal").modal("hide");
                        $("#dataa").load(window.location.href + " #dataa");
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

        // add admin account
        $("#add-admin-account").submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('add-account') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#add-admin-account")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#add-admin-modal").modal("hide");
                        $("#dataa").load(window.location.href + " #dataa");
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

        // edit account
        $(document).on("click", ".edit-btn", function() {
            var item_id = $(this).val();
            console.log(item_id);
            $("#edit-doctor-modal").modal("show");

            $.ajax({
                url: "/edit-user/" + item_id,
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $("#id1").val(item_id);
                    $("#name1").val(response.user.name);
                    $("#email1").val(response.user.email);

                },
            });
        });
        // delete account
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).val();
            console.log(id);
            $("#admin-password-modal").modal("show");
            $("#admin_id").val(id);
        })
        // update account
        $('#delete-account').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('delete-account') }}",
                data: new FormData(this),
                method: "post",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#delete-account")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#admin-password-modal").modal("hide");
                        $("#dataa").load(window.location.href + " #dataa");
                    } else {
                        $("#delete-account")[0].reset();
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
        // update account
        $('#update-account').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('update-account') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#update-account")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#edit-doctor-modal").modal("hide");
                        $("#dataa").load(window.location.href + " #dataa");
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
        // select account to create
        var doctorBtn = document.getElementsByClassName('btn-doctor')[0];
        var staffBtn = document.getElementsByClassName('btn-staff')[0];
        var adminBtn = document.getElementsByClassName('btn-admin')[0];
        doctorBtn.addEventListener('mouseover', function() {
            this.classList.add('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });

        doctorBtn.addEventListener('mouseout', function() {
            this.classList.remove('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });
        staffBtn.addEventListener('mouseover', function() {
            this.classList.add('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });

        staffBtn.addEventListener('mouseout', function() {
            this.classList.remove('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });
        adminBtn.addEventListener('mouseover', function() {
            this.classList.add('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });

        adminBtn.addEventListener('mouseout', function() {
            this.classList.remove('bg-primary', 'text-white', 'animate__animated', 'animate__flash');
        });
    </script>
@endsection
