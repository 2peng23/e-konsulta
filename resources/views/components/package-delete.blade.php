<!-- Edit Doctor -->
<div class="modal fade" id="package-password-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('delete-package') }}" method="post" id="delete-package">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="admin_password" class="form-label">Enter Password to Continue</label>
                        <input type="password" name="admin_password" class="form-control" id="admin_password">
                    </div>
                </div>
                <input type="text" name="admin_id" id="admin_id" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
