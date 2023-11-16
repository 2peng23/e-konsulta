<!-- Edit Doctor -->
<div class="modal fade" id="edit-doctor-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Doctor Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if ($doctor->isEmpty())
                <div class="modal-body">
                    <p>No doctor available.</p>
                </div>
            @else
                <form action="{{ route('update-account') }}" method="POST" id="update-account">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name1" class="form-label">Doctor Name</label>
                            <select name="name" id="name1" class="form-select">
                                @foreach ($doctor as $item)
                                    <option value="{{ $item->name }}">Dr. {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="email1" class="form-label">Email</label>
                            <input type="email" required name="email" class="form-control" id="email1">
                        </div>
                        <div class="mb-3">
                            <label for="password1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password1">
                        </div>
                    </div>
                    <input type="text" name="usertype" value="2" hidden>
                    <input type="text" name="id" id="id1" hidden>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
