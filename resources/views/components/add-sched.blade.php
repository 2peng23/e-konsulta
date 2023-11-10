<!-- AddModal -->
<div class="modal fade" id="add-sched" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Schedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('add-sched') }}" method="POST" id="add-sched">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input autofocus type="date" name="date" class="form-control" id="date">
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="time1" class="form-label">Time</label>

                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 7:00 am -->
                            <input type="checkbox" class="btn-check" id="timestamp1" autocomplete="off" value="7:00am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp1">7:00am</label>

                            <!-- 7:30 am -->
                            <input type="checkbox" class="btn-check" id="timestamp2" autocomplete="off" value="7:30am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp2">7:30am</label>

                            <!-- 8:00 am -->
                            <input type="checkbox" class="btn-check" id="timestamp3" autocomplete="off" value="8:00am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp3">8:00am</label>

                            <!-- 8:30 am -->
                            <input type="checkbox" class="btn-check" id="timestamp4" autocomplete="off" value="8:30am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp4">8:30am</label>

                            <!-- 9:00 am -->
                            <input type="checkbox" class="btn-check" id="timestamp5" autocomplete="off" value="9:00am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp5">9:00am</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 9:30 am -->
                            <input type="checkbox" class="btn-check" id="timestamp6" autocomplete="off" value="9:30am"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp6">9:30am</label>

                            <!-- 10:00 am -->
                            <input value="10:00am" type="checkbox" class="btn-check" id="timestamp7" autocomplete="off"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp7">10:00am</label>

                            <!-- 10:30 am -->
                            <input value="10:30am" type="checkbox" class="btn-check" id="timestamp8" autocomplete="off"
                                name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp8">10:30am</label>

                            <!-- 11:00 am -->
                            <input value="11:00am" type="checkbox" class="btn-check" id="timestamp9"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp9">11:00am</label>

                            <!-- 11:30 am -->
                            <input value="11:30am" type="checkbox" class="btn-check" id="timestamp10"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp10">11:30am</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 12:00 pm -->
                            <input value="12:00pm" type="checkbox" class="btn-check" id="timestamp11"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp11">12:00pm</label>

                            <!-- 12:30 pm -->
                            <input value="12:30pm" type="checkbox" class="btn-check" id="timestamp12"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp12">12:30pm</label>

                            <!-- 1:00 pm -->
                            <input value="1:00pm" type="checkbox" class="btn-check" id="timestamp13"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp13">1:00pm</label>

                            <!-- 1:30 pm -->
                            <input value="1:30pm" type="checkbox" class="btn-check" id="timestamp14"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp14">1:30pm</label>

                            <!-- 2:00 pm -->
                            <input value="2:00pm" type="checkbox" class="btn-check" id="timestamp15"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp15">2:00pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 2:30 pm -->
                            <input value="2:30pm" type="checkbox" class="btn-check" id="timestamp16"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp16">2:30pm</label>

                            <!-- 3:00 pm -->
                            <input value="3:00pm" type="checkbox" class="btn-check" id="timestamp17"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp17">3:00pm</label>

                            <!-- 3:30 pm -->
                            <input value="3:30pm" type="checkbox" class="btn-check" id="timestamp18"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp18">3:30pm</label>

                            <!-- 4:00 pm -->
                            <input value="4:00pm" type="checkbox" class="btn-check" id="timestamp19"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp19">4:00pm</label>

                            <!-- 4:30 pm -->
                            <input value="4:30pm" type="checkbox" class="btn-check" id="timestamp20"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp20">4:30pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 5:00 pm -->
                            <input value="5:00pm" type="checkbox" class="btn-check" id="timestamp21"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp21">5:00pm</label>

                            <!-- 5:30 pm -->
                            <input value="5:30pm" type="checkbox" class="btn-check" id="timestamp22"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp22">5:30pm</label>

                            <!-- 6:00 pm -->
                            <input value="6:00pm" type="checkbox" class="btn-check" id="timestamp23"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp23">6:00pm</label>

                            <!-- 6:30 pm -->
                            <input value="6:30pm" type="checkbox" class="btn-check" id="timestamp24"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp24">6:30pm</label>

                            <!-- 7:00 pm -->
                            <input value="7:00pm" type="checkbox" class="btn-check" id="timestamp25"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp25">7:00pm</label>
                        </div>
                        <div class="d-flex justify-content-between mt-2 ">
                            <!-- 7:30 pm -->
                            <input value="7:30pm" type="checkbox" class="btn-check" id="timestamp26"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp26">7:30pm</label>

                            <!-- 8:00 pm -->
                            <input value="8:00pm" type="checkbox" class="btn-check" id="timestamp27"
                                autocomplete="off" name="time[]">
                            <label class="btn btn-outline-primary" style="font-size:15px;"
                                for="timestamp27">8:00pm</label>
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
