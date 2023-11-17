 <!-- Start portfolio -->
 <section class="portfolio section" id="doctor-section">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="section-title">
                     <h2>Meet our best <span class="text-primary">doctors</span>!</h2>
                     <img src="user/img/section-img.png" alt="#">
                     <p>Welcome to our esteemed team of dedicated medical professionals. Our doctors bring a wealth of
                         expertise and a passion for patient care to every consultation.</p>
                 </div>
             </div>
         </div>
     </div>
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12 col-12">
                 <div class="owl-carousel portfolio-slider">
                     @foreach ($doctor as $item)
                         <div class="wow fadeInRight" data-wow-delay="0.5s" data-wow-duration="2s">
                             <img src="images/{{ $item->image }}" class="w-75" style="height: 280px" alt="#">
                             <div>
                                 <p style="font-weight: bold; font-size:20px">Dr. {{ $item->name }}</p>
                                 <p>{{ $item->expertise }}</p>
                             </div>
                             @php
                                 $doctor = App\Models\Schedule::where('name', $item->name)->count();
                             @endphp
                             {{-- @if ($doctor > 0) --}}
                             <a @if (Auth::check()) href="{{ route('make-appointment', [$item->id, $item->name]) }}"
                                    @else
                                    href="/login" @endif
                                 class="btn text-white">Make an appointment
                             </a>
                             {{-- @endif --}}
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--/ End portfolio -->
