<section>
    <div class="container">
      <div class="title center">
        <h4 class="upper">Some of the best.</h4>
        <h3>Our Clients<span class="red-dot"></span></h3>
        <hr>
      </div>
      <div class="section-content">
        <div class="boxes clients">
          <div class="row">

            @php
                $client_data= App\Models\Client::where('status', true)->where('trash', false)->take(6)-> latest()->get();
                $i=1;
                
            @endphp

          @foreach ($client_data as $client)
         @php
             if ($i==1) {
              $borderClass='border-right border-bottom';
              $delay=0;
             }elseif ($i==2) {
              $borderClass='border-right border-bottom';
              $delay=500;
             }elseif ($i==3) {
              $borderClass=' border-bottom';
              $delay=1000;
             }elseif ($i==4) {
              $borderClass='border-right ';
              $delay=0;
             }elseif ($i==5) {
              $borderClass='border-right ';
              $delay=500;
             }elseif ($i==6) {
              $borderClass='';
              $delay=1000;
             }
         @endphp
          <div class="col-sm-4 col-xs-6 {{$borderClass}} ">
            <img src="{{url('storage/client/' . $client->logo)}}" alt="" data-animated="true" data-delay="{{$delay}}" class="client-image">
          </div>
          @php
              $i++
          @endphp
          @endforeach

          </div>
          <!-- end of row-->
        </div>
      </div>
      <!-- end of section content-->
    </div>
  </section>



  {{-- <div class="row">
    <div class="col-sm-4 col-xs-6 border-right border-bottom">
      <img src="images/clients/1.png" alt="" data-animated="true" class="client-image fade-in-top">
    </div>

    <div class="col-sm-4 col-xs-6 border-right border-bottom">
      <img src="images/clients/2.png" alt="" data-animated="true" data-delay="500" class="client-image fade-in-top">
    </div>

    <div class="col-sm-4 col-xs-6 border-bottom">
      <img src="images/clients/3.png" alt="" data-animated="true" data-delay="1000" class="client-image fade-in-top">
    </div>

    <div class="col-sm-4 col-xs-6 border-right">
      <img src="images/clients/4.png" alt="" data-animated="true" class="client-image fade-in-top">
    </div>

    <div class="col-sm-4 col-xs-6 border-right">
      <img src="images/clients/5.png" alt="" data-animated="true" data-delay="500" class="client-image fade-in-top">
    </div>
    <div class="col-sm-4 col-xs-6">
      <img src="images/clients/6.png" alt="" data-animated="true" data-delay="1000" class="client-image fade-in-top">
    </div>
  </div> --}}