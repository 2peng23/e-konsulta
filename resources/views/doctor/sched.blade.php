@extends('layouts.doctor')
@section('content')
    <div class="d-flex justify-content-end ">
        <button class="btn btn-primary add-btn">
            <i class="fa fa-calendar-plus"></i>
        </button>
    </div>
    <x-add-sched />
    <x-ajax-message />
@endsection
@section('scripts')
    <script>
        // add doctor
        $(".add-btn").on("click", function() {
            console.log("Hello");
            $("#add-sched").modal("show");
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
    </script>
@endsection
