@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-add">
            Add Package
        </button>
    </div>
    @php
        $package = App\Models\Package::paginate(5);
    @endphp
    <div class="data">
        @if ($package->isEmpty())
            <p class="my-3 text-red">
                No package available.
            </p>
        @else
            <div class="my-2 container">
                <div class="row">
                    @foreach ($package as $item)
                        <div class="col-lg-6 col-12 my-2">
                            <div class="card shadow table-responsive " style="max-height: 380px;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between ">
                                        <h5 class="card-title">{{ $item->name }}</h5>
                                        <p class="text-primary">P{{ $item->price }}</p>
                                    </div>
                                    <div class="my-2">
                                        <form action="{{ route('add-inclusion') }}" method="POST" id="add-inclusion-form">
                                            @csrf
                                            <div class="d-flex gap-2">
                                                <input type="hidden" value="{{ $item->id }}" name="inc_id">
                                                <input type="text" required placeholder="Add new inclusion"
                                                    name="new_inclusion" class="form-control">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3">
                                        @foreach ($item->inclusion as $index => $inclusion)
                                            @if ($inclusion !== null)
                                                <div class="card" style="width: 150px">
                                                    <div
                                                        class="px-3 py-1 d-flex justify-content-between align-items-center">
                                                        <p>{{ $inclusion }}</p>
                                                        <button value="{{ $item->id }}" data-index="{{ $index }}"
                                                            class="btn delete-inc">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end mt-5">
                                        <div>
                                            <button value="{{ $item->id }}" class="btn btn-sm btn-primary edit-package">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                            <button value="{{ $item->id }}"
                                                class="btn btn-sm btn-danger delete-package">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
    <x-add-package />
    <x-edit-package />
    <x-ajax-message />
    <x-package-delete />
@endsection
@section('scripts')
    <script>
        // add package
        $(document).on('click', '.btn-add', function() {
            $('#add-package-modal').modal('show');
            // Counter for dynamic ID generation
            let inclusionCount = 1;
            // Add Inclusion button click event
            $("#add-inclusion").on("click", function(e) {
                e.preventDefault();
                inclusionCount++;

                // Clone the original inclusion input and update attributes
                let newInclusionInput = $("#inclusion1").clone();
                newInclusionInput.attr({
                    "id": "inclusion" + inclusionCount,
                    "name": "inclusion[]",
                }).val('');
                // Create a new div with class "my-1 form-control"
                let newDiv = $("<div>").addClass("my-1 col-6");
                // Append the new inclusion input to the new div
                newDiv.append(newInclusionInput);

                // Append the new inclusion input to the container
                $(".inc-container").append(newDiv);
            });
        })

        $(document).on('submit', '#add-package-form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('add-package') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#add-package-form")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#add-package-modal").modal("hide");
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
        })
        // delete inclusion
        $(document).on('click', '.delete-inc', function() {
            var id = $(this).val();
            var index = $(this).data('index');
            $.ajax({
                url: "{{ route('delete-inclusion') }}",
                data: {
                    id: id,
                    index: index
                },
                type: "get",
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                    } else {
                        $("#error-modal").modal("show");
                        $("#error-message").html(result.error);
                        $(".data").load(window.location.href + " .data");
                    }
                    // If you want to hide a success message after 1.5 seconds, uncomment the following lines
                    setTimeout(function() {
                        $("#success-modal").modal("hide");
                        $("#error-modal").modal("hide");
                    }, 2000);
                },
            })
        });
        // add inclusion
        $(document).on('submit', '#add-inclusion-form', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('add-inclusion') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#add-inclusion-form")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
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
        })
        // delete package
        $(document).on('click', '.delete-package', function() {
            $('#package-password-modal').modal('show');
            var id = $(this).val();
            $('#admin_id').val(id);
        })
        $(document).on('submit', '#delete-package', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('delete-package') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#delete-package")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#package-password-modal").modal("hide");
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
        })
        // edit package
        $(document).on('click', '.edit-package', function() {
            var id = $(this).val();
            $('#edit-package-modal').modal('show');
            $.ajax({
                url: "{{ route('get-package') }}",
                data: {
                    id: id
                },
                type: "get",
                success: function(res) {
                    var data = res.package;
                    $('#update_id').val(data.id);
                    $('#edit_name').val(data.name)
                    $('#edit_price').val(data.price)
                }
            })
        })
        $(document).on('submit', '#update-package', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('update-package') }}",
                data: new FormData(this),
                method: "POST",
                processData: false,
                contentType: false,
                success: function(result) {
                    console.log(result);
                    if (result.success) {
                        $("#update-package")[0].reset();
                        $("#success-modal").modal("show");
                        $("#success-message").html(result.success);
                        // If you want to hide the modal after a successful submission, uncomment the following line
                        $("#edit-package-modal").modal("hide");
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
        })
    </script>
@endsection
