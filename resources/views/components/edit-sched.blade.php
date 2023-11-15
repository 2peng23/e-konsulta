<!-- AddModal -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Schedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-sched') }}" method="POST" id="update-sched">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input autofocus type="date" name="date" class="form-control" id="edit-date"
                            min="<?php echo date('Y-m-d'); ?>">

                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="sched_id" id="sched_id">
                    </div>
                    <div class="mb-3">
                        <label for="time1" class="form-label">Time</label>

                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 7:00 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp1" autocomplete="off"
                                value="7:00am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp1">7:00am</label>

                            <!-- 7:30 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp2" autocomplete="off"
                                value="7:30am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp2">7:30am</label>

                            <!-- 8:00 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp3" autocomplete="off"
                                value="8:00am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp3">8:00am</label>

                            <!-- 8:30 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp4" autocomplete="off"
                                value="8:30am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp4">8:30am</label>

                            <!-- 9:00 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp5" autocomplete="off"
                                value="9:00am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp5">9:00am</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 9:30 am -->
                            <input type="checkbox" class="btn-check" id="edit-timestamp6" autocomplete="off"
                                value="9:30am" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp6">9:30am</label>

                            <!-- 10:00 am -->
                            <input value="10:00am" type="checkbox" class="btn-check" id="edit-timestamp7"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp7">10:00am</label>

                            <!-- 10:30 am -->
                            <input value="10:30am" type="checkbox" class="btn-check" id="edit-timestamp8"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp8">10:30am</label>

                            <!-- 11:00 am -->
                            <input value="11:00am" type="checkbox" class="btn-check" id="edit-timestamp9"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp9">11:00am</label>

                            <!-- 11:30 am -->
                            <input value="11:30am" type="checkbox" class="btn-check" id="edit-timestamp10"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp10">11:30am</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 12:00 pm -->
                            <input value="12:00pm" type="checkbox" class="btn-check" id="edit-timestamp11"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp11">12:00pm</label>

                            <!-- 12:30 pm -->
                            <input value="12:30pm" type="checkbox" class="btn-check" id="edit-timestamp12"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp12">12:30pm</label>

                            <!-- 1:00 pm -->
                            <input value="1:00pm" type="checkbox" class="btn-check" id="edit-timestamp13"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp13">1:00pm</label>

                            <!-- 1:30 pm -->
                            <input value="1:30pm" type="checkbox" class="btn-check" id="edit-timestamp14"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp14">1:30pm</label>

                            <!-- 2:00 pm -->
                            <input value="2:00pm" type="checkbox" class="btn-check" id="edit-timestamp15"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp15">2:00pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 2:30 pm -->
                            <input value="2:30pm" type="checkbox" class="btn-check" id="edit-timestamp16"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp16">2:30pm</label>

                            <!-- 3:00 pm -->
                            <input value="3:00pm" type="checkbox" class="btn-check" id="edit-timestamp17"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp17">3:00pm</label>

                            <!-- 3:30 pm -->
                            <input value="3:30pm" type="checkbox" class="btn-check" id="edit-timestamp18"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp18">3:30pm</label>

                            <!-- 4:00 pm -->
                            <input value="4:00pm" type="checkbox" class="btn-check" id="edit-timestamp19"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp19">4:00pm</label>

                            <!-- 4:30 pm -->
                            <input value="4:30pm" type="checkbox" class="btn-check" id="edit-timestamp20"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp20">4:30pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 5:00 pm -->
                            <input value="5:00pm" type="checkbox" class="btn-check" id="edit-timestamp21"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp21">5:00pm</label>

                            <!-- 5:30 pm -->
                            <input value="5:30pm" type="checkbox" class="btn-check" id="edit-timestamp22"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp22">5:30pm</label>

                            <!-- 6:00 pm -->
                            <input value="6:00pm" type="checkbox" class="btn-check" id="edit-timestamp23"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp23">6:00pm</label>

                            <!-- 6:30 pm -->
                            <input value="6:30pm" type="checkbox" class="btn-check" id="edit-timestamp24"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp24">6:30pm</label>

                            <!-- 7:00 pm -->
                            <input value="7:00pm" type="checkbox" class="btn-check" id="edit-timestamp25"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp25">7:00pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 7:30 pm -->
                            <input value="7:30pm" type="checkbox" class="btn-check" id="edit-timestamp26"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp26">7:30pm</label>

                            <!-- 8:00 pm -->
                            <input value="8:00pm" type="checkbox" class="btn-check" id="edit-timestamp27"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="edit-timestamp27">8:00pm</label>
                        </div>
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
