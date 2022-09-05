@extends('frontend.layout.app')

@section('frontend-content')
<section id="home">
    <!-- Home Slider-->
    <div id="home-slider" class="flexslider">
      <ul class="slides">
        @forelse ($slider_data as $slider)
        <li>
          <img src="{{url('storage/slider/' . $slider->photo)}}" alt="">
          <div class="slide-wrap">
            <div class="slide-content">
              <div class="container">
                <h1>{{$slider->title}}<span class="red-dot"></span></h1>
                <h6>{{$slider->subTitle}}</h6>
                @if ($slider->btn)
                <p>
                  @foreach (json_decode($slider->btn) as $item)
                  <a href="{{$item->btn_link}}" class="btn {{$item->btn_type}}">{{$item->btn_title}}</a>
                  @endforeach                              
                </p>
                @endif
                
              </div>
            </div>
          </div>
        </li>
        @empty
            
        @endforelse
        
        
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