@extends('frontend.layout.app')

@section('frontend-content')

<section class="page-title parallax">
    <div data-parallax="scroll" data-image-src="comet/images//bg/12.jpg" class="parallax-bg"></div>
    <div class="parallax-overlay">
      <div class="centrize">
        <div class="v-center">
          <div class="container">
            <div class="title center">
              <h1 class="upper">{{$single_data->title}}<span class="red-dot"></span></h1>
              <h4>Our best work.</h4>
              <hr>
            </div>
          </div>
          <!-- end of container-->
        </div>
      </div>
    </div>
</section>

<section class="b-0">
    <div class="container">
      <div data-options="{&quot;animation&quot;: &quot;slide&quot;, &quot;controlNav&quot;: true, &quot;directionNav&quot;: true}" class="flexslider nav-inside">
        <ul class="slides">
            @foreach (json_decode($single_data->gallery) as $gallery)
            <li>
                <img style="width: 100%;height:600px" src="{{url('storage/portfolio/gallery/' . $gallery)}}" alt="">
            </li>
            @endforeach
          
          
        </ul>
      </div>
    </div>
</section>

<section class="p-0 b-0">
    <div class="boxes">
      <div class="container-fluid">
        <div class="row">
            @php
                $i=1;
            @endphp

            @foreach (json_decode($single_data->steps) as $step)
            <div data-bg-color="#eaeaea" class="col-md-4">
                <div class="number-box"><span>Step No.</span>
                  <h2>0{{$i}}<span class="red-dot"></span></h2>
                  <h4>{{$step->title}}.</h4>
                  <p>{{$step->desc}}.</p>
                </div>
              </div>
              @php
              $i++;
          @endphp
            @endforeach
          

         
        </div>
        <!-- end of row-->
      </div>
    </div>
</section>

<section>
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="project-detail">
            <p><strong>Client:</strong>{{$single_data->client}}.</p>
            <p><strong>Date:</strong>{{Date('F d, Y', strtotime($single_data->date) )}}</p>
            <p><strong>Link:</strong><a href="{{$single_data->link}}">{{$single_data->link}}</a>
            </p>
            <p><strong>Type:</strong>{{$single_data->type}}</p>
          </div>
        </div>
        <div class="col-sm-8">
          {!! htmlspecialchars_decode($single_data->desc) !!}
        </div>
       
      </div>
    </div>
</section>

<section class="controllers p-0">
    <div class="container">
      <div class="projects-controller"><a href="#" class="prev"><span><i class="ti-arrow-left"></i>Previous</span></a><a href="#" class="all"><span><i class="ti-layout-grid2"></i></span></a><a href="#" class="next"><span>Next<i class="ti-arrow-right"></i></span></a>
      </div>
    </div>
</section>






@endsection