<section>
    <div class="container">
      <div class="row">

        @php
            $counter_data= App\Models\Counter::where('status', true)->where('trash', false)->take(4)->latest()->get();
        @endphp

        @foreach ($counter_data as $counter)
        <div class="col-md-3 col-sm-6">
          <div class="counter">
            <div class="counter-icon"><i class="{{$counter->icon}}"></i>
            </div>
            <div class="counter-content">
              <h5><span data-count="{{$counter->projectNumber}}" class="number-count">{{$counter->projectNumber}}/span><span class="red-dot"></span></h5><span>{{$counter->title}}</span>
            </div>
          </div>
        </div>
        @endforeach
        
        
      </div>
    </div>
  </section>