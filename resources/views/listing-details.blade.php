@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">By {{$user->name}}  </div>
                    <div class="your-class">
                       @foreach($details->pictures as $picture) 
                        <img src="{{route('storage', $picture->picture)}}"/>
                        @endforeach
                    </div>
                {{-- <img src="https://www.imgacademy.com/themes/custom/imgacademy/images/helpbox-contact.png"/> --}}
                <div class="panel-body">
                    {{$details->description}}<br/>
                    Distance from stadium: {{$details->distance_stadium}} km<br/>
                    Number of beds: {{$details->no_beds}}<br/>
                    From - To<br/>
                    {{$details->date_from}} - {{$details->date_to}}
                </div>
            </div>

        </div>
    </div>
</div>
<div id="mapWrapper" style="height:500px; width:1000px; margin-left: 420px;">
<div id="map" style="height:100%"></div>
</div>


    <h1 style="text-align: center;">CONTACT HOST</h1>
    <div style="margin-left: 430px; width:1000px"> 
        {!! Form::open(array('route' => 'contact.store', 'class' => 'form', 'files'=>true))!!}
        {{ Form::hidden('listing_id', $details->id) }}
         <div class="form-group">
                {!! Form::label('E-mail Address') !!}
                {!! Form::text('email', $user->email, 
                    array(
                        'class'=>'form-control', 
                        'placeholder'=>'Enter contact e-mail address')) !!}
        </div>
       <div class="form-group">
            {!! Form::label('Message:')!!}
            {!! Form::textarea('message', null, 
                array( 
                    'class'=>'form-control', 
                    'placeholder'=>'Enter message.'))!!}
        </div>
        <div class="form-group">
                {!! Form::submit('Send email', 
                  array('class'=>'btn btn-primary form-control')) !!}
        </div>
         {!! Form::close() !!}
            @foreach($errors->all() as $error)
                <li class="alert alert-danger">{{$error}}</li>
            @endforeach
    </div>
    <script>
      // This example creates circles on the map, representing populations in North
      // America.

      // First, create an object containing LatLng and population for each city.
      var citymap = {
        destination: {
          center: {lat: {{$details->lat}}, lng: {{$details->lng}}},
          population: 5
        },
      };

      function initMap() {
        // Create the map.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: {{$details->lat}}, lng: {{$details->lng}} },
        });

        // Construct the circle for each value in citymap.
        // Note: We scale the area of the circle based on the population.
        for (var city in citymap) {
          // Add the circle for this city to the map.
          var cityCircle = new google.maps.Circle({
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: '#FF0000',
            fillOpacity: 0.35,
            map: map,
            center: citymap[city].center,
            radius: Math.sqrt(citymap[city].population) * 100
          });
        }
      }
      
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key={{env('API_KEY')}}&callback=initMap">
    </script>


  <script type="text/javascript">
    $(document).ready(function(){
      $('.your-class').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        autoplay: true,
        prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left"></i></div>',
        nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right"></i></div>'
      });
    });
  </script>
  @section('additionalCss')
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
  @endsection
  @section('additionalJs')
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
  @endsection
  
@endsection
