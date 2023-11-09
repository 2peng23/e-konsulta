<!-- AddModal -->
<div class="modal fade" id="edit-doctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Doctor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-doctor') }}" method="POST" id="update-doctor">
                @csrf
                <input type="text" name="item_id" id="item_id" hidden>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input autofocus type="text" name="name" class="form-control" id="edit-name">
                    </div>
                    <div class="mb-1">
                        <img id="edit-preview" class="rounded-circle" src="" alt=""
                            style="width: 120px">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="edit-image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="expertise" class="form-label">Expertise</label>
                        <input type="text" name="expertise" class="form-control" id="edit-expertise">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
