<!-- AddModal -->
<div class="modal fade" id="patient-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Patient Information</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add-patient') }}" method="POST" id="add-patient-form">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input autofocus placeholder="Patient's Full Name" type="text" name="name"
                            class="form-control p-1" id="patient_name" readonly>
                    </div>
                    <div class="mb-3">
                        <input autofocus placeholder="Address" type="text" name="address" class="form-control p-1"
                            id="address">
                    </div>
                    <div class="mb-3">
                        <input autofocus placeholder="Phone" type="number" name="phone" class="form-control p-1"
                            id="phone">
                    </div>
                    <div class="mb-3 row">


                        <div class="col-6">
                            <select name="civil_status" id="civil_status" class="form-control">
                                <option selected>Civil Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="widowed">Widowed</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="sex" id="sex" class="form-control">
                                <option selected>Sex</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <input autofocus placeholder="Age" type="number" name="age" class="form-control p-1"
                                id="age">
                        </div>
                        <div class="col-6">
                            <input autofocus placeholder="Birthday" type="date" name="birthday"
                                class="form-control p-1" id="birthday" max="<?php echo date('Y-m-d'); ?>">
                        </div>

                    </div>
                    <div class="mb-3">
                        <input type="text" name="father_name" placeholder="Father's Name (optional)"
                            class="form-control p-1">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="father_occupation" placeholder="Father's Occupation (optional)"
                            class="form-control p-1">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="mother_name" placeholder="Mother's Name (optional)"
                            class="form-control p-1">
                    </div>

                    <div class="mb-3">
                        <input type="text" name="mother_occupation" placeholder="Mother's Occupation (optional)"
                            class="form-control p-1">
                    </div>
                    <div class="mb-3">
                        <input type="text" name="referred" placeholder="Referred by (optional)"
                            class="form-control p-1">
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
