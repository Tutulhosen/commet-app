@extends('frontend.layout.app')

@section('frontend-content')
<section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
      <ul class="slides">
        <li>
          <img src="frontend/images/bg/1.jpg" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>Digital Power<span class="red-dot"></span></h1>
                <h6>We are a small design studio from San Francisco.</h6>
                <p><a href="#" class="btn btn-light-out">Read More</a><a href="#" class="btn btn-color btn-full">Services</a>
                </p>
              </div>
            </div>
          </div>
        </li>
        <li>
          <img src="frontend/images/bg/2.jpg" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>We Are Comet<span class="red-dot"></span></h1>
                <h6>Experts in web design and development.</h6>
                <p><a href="#" class="btn btn-color">Explore</a><a href="#" class="btn btn-light-out">Join us</a>
                </p>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </div>
    <!-- End Home Slider-->
  </section>

  @include('frontend.pages.sections.about')
  @include('frontend.pages.sections.expertise')
  @include('frontend.pages.sections.vision')
  @include('frontend.pages.sections.portfolio')
  @include('frontend.pages.sections.clint')
  @include('frontend.pages.sections.testimonial')
  @include('frontend.pages.sections.blog')



@endsection