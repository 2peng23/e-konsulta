@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-end ">
        <button class="btn btn-primary add-btn">
            <i class="fa fa-user-plus"></i>
        </button>
    </div>
    <x-add-doctor />
    <x-edit-doctor />
    <x-ajax-message />

    <div id="dataa">
        @if ($doctor->isEmpty())
            <p>No doctor found.</p>
        @else
            {{-- Owl Carousel --}}
            <div id="doctor-data" class="mt-3 d-flex flex-wrap gap-2">
                @foreach ($doctor as $item)
                    <div class="card position-relative card-data" style="width: 12rem;">
                        <img src="images/{{ $item->image }}" style="height:180px;" class="card-img-top"
                            alt="{{ $item->name }}">
                        <div class="card-body">
                            <h5 class="card-title">Dr. {{ $item->name }}</h5>
                            <p class="card-text">{{ $item->expertise }}</p>
                        </div>
                        <div class="justify-content-end" id="action-btn" style="display: none;">
                            <button value="{{ $item->id }}" class="btn btn-edit"><i
                                    class="fa fa-pencil text-success"></i></button>
                            <button value="{{ $item->id }}" class="btn btn-delete"><i
                                    class="fa fa-trash text-danger"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // action hover
            toggleAction();

            function toggleAction() {
                const cards = document.querySelectorAll(".card-data");

                cards.forEach((card) => {
                    card.addEventListener("mouseover", () => {
                        card.querySelector("#action-btn").style.display = "flex";
                    });

                    card.addEventListener("mouseout", () => {
                        card.querySelector("#action-btn").style.display = "none";
                    });
                });
            }
            // add doctor
            $(".add-btn").on("click", function() {
                console.log("Hello");
                $("#add-modal").modal("show");
            });

            $("#add-doctor-form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('add-doctor') }}",
                    data: new FormData(this),
                    method: "POST",
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        console.log(result);
                        if (result.success) {
                            $("#add-doctor-form")[0].reset();
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            $("#preview").attr("src", "");
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#add-modal").modal("hide");
                            $("#dataa").load(
                                window.location.href + " #dataa",
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

            // Check for changes in the input file
            $("#image").change(function() {
                // Check if there is any file selected
                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#preview").attr("src", e.target.result);
                    };

                    reader.readAsDataURL(this.files[0]);
                }
            });

            // view image
            editImage();

            function editImage() {
                $("#edit-image").change(function() {
                    // Check if there is any file selected
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $("#edit-preview").attr("src", e.target.result);
                        };

                        reader.readAsDataURL(this.files[0]);
                    }
                });
            }

            // edit doctor
            $(document).on("click", ".btn-edit", function() {
                var item_id = $(this).val();
                console.log(item_id);
                $("#edit-doctor").modal("show");

                $.ajax({
                    url: "/edit-doctor/" + item_id,
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        $("#item_id").val(item_id);
                        $("#edit-name").val(response.doctor.name);
                        $("#edit-expertise").val(response.doctor.expertise);
                        $("#edit-preview").attr(
                            "src",
                            "images/" + response.doctor.image
                        );
                    },
                });
            });

            // update doctor
            $(document).ready(function() {
                $(document).on("submit", "#update-doctor", function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('update-doctor') }}",
                        data: new FormData(this),
                        method: "POST",
                        processData: false,
                        contentType: false,
                        success: function(result) {
                            console.log(result);
                            console.log(result.success);
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            $("#update-doctor")[0].reset();
                            $("#edit-doctor").modal("hide");
                            $("#doctor-data").load(
                                location.href + " #doctor-data",
                                function() {
                                    toggleAction();
                                }
                            );
                            // Hide success message after 1.5 seconds
                            setTimeout(function() {
                                $("#success-modal").modal("hide");
                            }, 1500);
                        },
                    });
                });
            });
            $(document).on("click", ".btn-delete", function() {
                var id = $(this).val();
                console.log(item_id);
                if (confirm("Delete this doctor?")) {
                    $.ajax({
                        url: "/delete-doctor",
                        type: "get",
                        data: {
                            id: id,
                        },
                        success: function(res) {
                            console.log(res);
                            $("#error-modal").modal("show");
                            $("#error-message").html(res.error);
                            $("#dataa").load(
                                location.href + " #dataa",
                                function() {
                                    toggleAction();
                                }
                            );
                            setTimeout(function() {
                                $("#error-modal").modal("hide");
                            }, 1500);
                        },
                    });
                }
            });
        });
    </script>
@endsection
