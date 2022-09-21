
@php
    $portfolio_data= App\Models\Portfolio::where('status', true)->where('trash', false)->take(8)->latest()->get();
    $category_data= App\Models\Category::where('status', true)->where('trash', false)->take(4)->latest()->get();
@endphp



<section id="portfolio" class="pb-0">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="title m-0 txt-xs-center txt-sm-center">
            <h2 class="upper">Selected Works<span class="red-dot"></span></h2>
            <hr>
          </div>
        </div>
        <div class="col-md-6">
          <ul id="filters" class="no-fix mt-25">

            <li data-filter="*" class="active">All</li>
            @foreach ($category_data as $category)
            <li data-filter=".{{$category->slug}}">{{$category->name}}</li>
            @endforeach


          </ul>
          <!-- end of portfolio filters-->
        </div>
      </div>
      <!-- end of row-->
    </div>
    <div class="section-content pb-0">
      <div id="works" class="four-col wide mt-50">
        @foreach ($portfolio_data as $portfolio)

        <div class="work-item @foreach($portfolio->category as $catt) {{$catt->slug}} @endforeach">
          <div class="work-detail">
            <a href="{{route('portfolio.single.page.index', $portfolio->slug)}}">
              <img style="width: 100%;height:350px;object-fit:cover" src="{{url('storage/portfolio/featherd/' . $portfolio->featured_image)}}" alt="">
              <div class="work-info">
                <div class="centrize">
                  <div class="v-center">
                    <h3>{{$portfolio->title}}</h3>
                    <p>@foreach ($portfolio->category as $pp)
                      {{$pp->name}}. 
                    @endforeach</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        @endforeach



      </div>
      <!-- end of portfolio grid-->
    </div>
  </section>