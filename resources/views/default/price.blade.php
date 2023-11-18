<!-- Pricing Table -->
<section class="pricing-table section" id="package-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>We Provide You The Best Laboratory Services Package</h2>
                    <img src="user/img/section-img.png" alt="#">
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $package = App\Models\Package::take(3)->get();
            @endphp

            <!-- Single Table -->
            @foreach ($package as $item)
                <div class="col-lg-4 col-md-12 col-12 wow fadeInDown">
                    <div class="single-table">
                        <!-- Table Head -->
                        <div class="table-head">
                            <div class="icon">
                                <i class="icofont icofont-box"></i>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h4 class="title">{{ $item->name }}</h4>
                                <h4 class="title text-primary">P{{ $item->price }}</h4>
                            </div>

                        </div>
                        <!-- Table List -->
                        <ul class="table-list text-uppercase">
                            <div class="row">
                                @foreach ($item->inclusion as $inc)
                                    <div class="col-6">
                                        <li><i class="icofont icofont-ui-check"></i>{{ $inc }}</li>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                        <div class="table-bottom">
                            <a class="btn"
                                @if (Auth::check()) href="{{ route('avail-package', $item->id) }}"
                            @else
                                href="/login" @endif>Avail</a>
                        </div>
                        <!-- Table Bottom -->
                    </div>
                </div>
            @endforeach
            <!-- End Single Table-->
        </div>
        <a href="{{ route('more-package') }}">
            <button id="more-pack" class="px-3 py-3 rounded bg-primary text-white">Show More</button>
        </a>
    </div>
</section>
<!--/ End Pricing Table -->
