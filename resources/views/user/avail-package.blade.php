@extends('layouts.user')
@section('content')
    <!-- Pricing Table -->
    <section class="pricing-table section" id="package-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Avail This Top-notch Laboratory Service Package</h2>
                        <img src="user/img/section-img.png" alt="#">
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Single Table -->
                <div class="col-lg-6 col-md-12 col-12 wow fadeInLeft">
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="icon">
                                <i class="icofont icofont-box"></i>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4 class="title">{{ $package->name }}</h4>
                                <h4 class="title text-primary">P{{ $package->price }}</h4>
                            </div>

                        </div>
                        <!-- Table List -->
                        <ul class="table-list text-uppercase">
                            <div class="row">
                                @foreach ($package->inclusion as $inc)
                                    <div class="col-6">
                                        <li><i class="icofont icofont-ui-check"></i>{{ $inc }}</li>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                        <!-- Table Bottom -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <img src="user/img/qrscan.svg" alt="" style="width: 200px">
                            </div>
                            <div>
                                <h5>Scan to pay</h5>
                                <img src="user/img/scan.jfif" alt="" style="width: 200px">
                            </div>
                        </div>
                        <div class="mt-5">
                            <h5>Gcash Payment Information</h5>
                            <div class="d-flex justify-content-evenly my-3">
                                <p class="fw-bolder" style="font-size: 20px">Juan Dela Cruz</p>
                                <p class="fw-bolder" style="font-size: 20px">09123456789</p>
                            </div>
                            <p style="font-style: italic" class="fw-bold text-muted my-5"> Don't forget to take screenshot
                                for
                                proof of
                                payment.</p>
                        </div>
                    </div>
                </div>
                <!-- End Single Table-->
                {{-- Payment Form --}}
                <div class="col-lg-6 col-md-12 col-12 wow fadeInRight">
                    <div class="single-table rounded p-5">
                        <h5 class="card-title">Biller Information</h5>
                        <form class="card-body" action="">
                            <div class="mb-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control p-2">
                            </div>
                            <div class="mb-2">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control p-2">
                            </div>
                            <div class="mb-2">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control p-2">
                            </div>
                            <div class="mb-2">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" name="amount" id="amount" class="form-control p-2">
                            </div>
                            <div class="mb-2">
                                <label for="image" class="form-label">Proof of Payment</label>
                                <input type="file" name="image" id="image" accept="image/*"
                                    class="form-control p-2">
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Pricing Table -->
@endsection
