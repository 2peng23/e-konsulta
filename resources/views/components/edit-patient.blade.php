<!-- AddModal -->
<div class="modal fade" id="edit-patient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-patient') }}" method="POST" id="update-patient">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="diagnosis" class="form-label">Diagnosis</label>
                        <input autofocus type="text" name="diagnosis[]" class="form-control" id="diagnosis">
                    </div>
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
