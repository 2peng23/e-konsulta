<!-- AddModal -->
<div class="modal fade" id="add-package-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Package</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add-package') }}" method="POST" id="add-package-form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Package Name</label>
                        <input autofocus type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="price">
                    </div>
                    <div class="inc-container row">
                        <p class="form-label">Inclusion(s)</p>
                        <div class="my-1 col-6">
                            <input type="text" name="inclusion[]" class="form-control" id="inclusion1">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end my-2">
                        <button class="btn btn-primary btn-sm" id="add-inclusion">
                            <i class="fa fa-plus"></i>
                        </button>
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
