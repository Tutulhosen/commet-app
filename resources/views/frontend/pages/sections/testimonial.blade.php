
    <section class="parallax">
        <div data-parallax="scroll" data-image-src="frontend/images/bg/7.jpg" class="parallax-bg"></div>
        <div class="parallax-overlay pb-50 pt-50">
          <div class="container">
            <div class="title center">
              <h3>What They Say<span class="red-dot"></span></h3>
              <hr>
            </div>
            <div class="section-content">
              <div id="testimonials-slider" data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true}" class="flexslider nav-outside">
                <ul class="slides">
                  @php
                      $testimonial_data= App\Models\Testimonial:: where('status', true)->where('trash', false)-> latest()->take(3)->get();
                  @endphp

                  @forelse ($testimonial_data as $testimonial)
                  <li>
                    <blockquote>
                      <p>"{{$testimonial->testimonial}}"</p>
                      <footer>{{$testimonial->name}} - {{$testimonial->company}}.</footer>
                    </blockquote>
                  </li>  
                  @empty
                      
                  @endforelse
                   

                </ul>
              </div>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </section>