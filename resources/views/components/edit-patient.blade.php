<!-- AddModal -->
<div class="modal fade" id="edit-patient" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Patient</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-patient') }}" method="POST" id="update-patient-form">
                @csrf
                <div class="modal-body">
                    <div class="page-1">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <input autofocus placeholder="Patient's Full Name" type="text" name="name"
                                class="form-control" id="edit-name" readonly>
                        </div>
                        <div class="mb-3">
                            <input autofocus placeholder="Address" type="text" name="address" class="form-control"
                                id="edit-address">
                        </div>
                        <div class="mb-3">
                            <input autofocus placeholder="Phone" type="number" name="phone" class="form-control"
                                id="edit-phone">
                        </div>
                        <div class="mb-3 row">


                            <div class="col-6">
                                <select name="civil_status" id="edit-civil_status" class="form-control">
                                    <option selected>Civil Status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <select name="sex" id="edit-sex" class="form-control">
                                    <option selected>Sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-6">
                                <input autofocus placeholder="Age" type="number" name="age" class="form-control"
                                    id="edit-age">
                            </div>
                            <div class="col-6">
                                <input autofocus placeholder="Birthday" type="date" name="birthday"
                                    class="form-control" id="edit-birthday" max="<?php echo date('Y-m-d'); ?>">
                            </div>

                        </div>
                        <div class="mb-3">
                            <input type="text" name="father_name" id="edit-father_name"
                                placeholder="Father's Name (optional)" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="edit-father_occupation" name="father_occupation"
                                placeholder="Father's Occupation (optional)" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" name="mother_name" id="edit-mother_name"
                                placeholder="Mother's Name (optional)" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="edit-mother_occupation" name="mother_occupation"
                                placeholder="Mother's Occupation (optional)" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end ">

                            <button class="btn btn-primary next-btn"> Next <i class="fa fa-angle-right"></i></button>
                        </div>
                    </div>
                    <div class="page-2" style="display: none">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <input autofocus placeholder="Weight" type="text" name="weight"
                                    class="form-control" id="edit-weight">
                            </div>
                            <div class="mb-3 col-6">
                                <input autofocus placeholder="Height" type="text" name="height"
                                    class="form-control" id="edit-height">
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea name="complaints" class="form-control" placeholder="Complaints" id="edit-complaints" cols="10"
                                rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="diagnosis[]" class="form-control" placeholder="Diagnosis" id="edit-diagnosis" cols="10"
                                rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <textarea name="treatment" class="form-control" placeholder="Presciption" id="edit-treatment" cols="10"
                                rows="3"></textarea>
                        </div>
                        <div class="d-flex justify-content-between modal-footer">
                            <button class="btn btn-primary prev-btn"><i class="fa fa-angle-left"></i> Prev</button>
                            <div class="">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
