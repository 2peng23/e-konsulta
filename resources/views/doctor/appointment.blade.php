@extends('layouts.doctor')
@section('content')
    @php
        $appointment = App\Models\Appointment::where('doctor', Auth::user()->name)->get();
    @endphp
    <x-ajax-message />
    <div id="data">
        @if ($appointment->isEmpty())
            <p>No appointment available.</p>
        @else
            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Email</th>
                            <th>Phone</th>
                            {{-- <th>Message</th> --}}
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
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                {{-- <td>{{ $item->message }}</td> --}}
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <button value="{{ $item->id }}" class="bn632-hover bn26 approve-btn"
                                            style="font-size: 14px"><i class="fa fa-thumbs-up"
                                                id="approve-icon"></i>approve</button>
                                        <button value="{{ $item->id }}" class="bn632-hover bn27 decline-btn"
                                            style="font-size: 14px"><i class="fa fa-thumbs-down"
                                                id="decline-icon"></i>decline</button>
                                    @elseif($item->status == 'cancelled')
                                        <p>cancelled</p>
                                    @elseif($item->status == 'declined')
                                        <p>declined</p>
                                    @else
                                        <p>approved</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- {{ $appointment->links() }} --}}
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // approve
            $('.approve-btn').on('click', function() {
                var id = $(this).val();
                // Find the icon within the button
                var icon = $(this).find("#approve-icon");
                // Remove existing classes and add new classes
                icon.removeClass("fa-thumbs-up").addClass("fa-spinner rotate");
                console.log(id);
                $.ajax({
                    url: "/approve/" + id,
                    data: {
                        id: id
                    },
                    type: "get",
                    success: function(result) {
                        if (result.success) {
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#data").load(
                                window.location.href + " #data"
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
                    }
                })
            })
            // decline
            $('.decline-btn').on('click', function() {
                var id = $(this).val();
                // Find the icon within the button
                var icon = $(this).find("#decline-icon");
                // Remove existing classes and add new classes
                icon.removeClass("fa-thumbs-down").addClass("fa-spinner rotate");
                console.log(id);
                $.ajax({
                    url: "/decline/" + id,
                    data: {
                        id: id
                    },
                    type: "get",
                    success: function(result) {
                        if (result.success) {
                            $("#success-modal").modal("show");
                            $("#success-message").html(result.success);
                            // If you want to hide the modal after a successful submission, uncomment the following line
                            $("#data").load(
                                window.location.href + " #data"
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
                    }
                })
            })
        })
    </script>
@endsection
