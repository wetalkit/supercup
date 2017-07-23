@extends('layouts.app')

@section('content')

<section class="listing">
    <div class="container">
      
      <div class="back">
          <a href="/"><label><i class="glyphicon glyphicon-circle-arrow-left"></i> Back</label></a>
      </div>
      <hr/>

      <div class="listing-details clearfix">

        <div class="heading clearfix">
          <div class="col-md-9 col-sm-9">
            <div class="title"><h2>{!! $details->title !!}</h2></div>
            <div class="by">
              <label>by</label> 
              <div class="img"><img src="{!! $details->user->fb_avatar !!}"/></div>
              <div class="name">{!! $details->user->name !!}</div>
            </div>
          </div>

          <div class="col-md-3 col-sm-3">
          @if($user)
            <button type="button" class="btn btn-orange" data-toggle="modal"  data-target="#messageHost">Message Host</button>
          @else
            <button type="button" class="btn btn-orange" data-toggle="modal"  data-target="#loginModal">Message Host</button>
          @endif
          </div>
        </div>
        <hr/>

          
        <div class="col-md-6 col-sm-6">

          <div class="images-slider">
            @foreach($details->pictures as $picture) 
              <img src="{{route('storage', $picture->picture)}}" alt="{!! $details->title !!}"/>
            @endforeach
          </div>

        </div>

        <div class="col-md-6 col-sm-6">
          <div class="details">
            <h5>Description:</h5>
            <p>{!! $details->description !!}</p>

            <h5>Distance from stadium:</h5>
            <p>{!! $details->distance_stadium !!}</p>

            <h5>Number of beds:</h5>
            <p>{!! $details->no_beds !!}</p>

            <h5>Available:</h5>
            <p>From {!! $details->date_from !!} to {!! $details->date_to !!}</p>
          </div>
        </div>

        <hr/>

      </div>

      <div style="height:400px; width:100%" class="clearfix">
        <div id="map" style="height:100%"></div>
      </div>

</div>

</section>

@if($user)

  <div id="messageHost" class="modal fade" role="dialog">
    <div class="modal-dialog">
    
    {!! Form::open(['route' => 'contact.store', 'class' => 'form']) !!}

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message {!! $details->user->name !!}</h4>
      </div>

      @foreach($errors->all() as $error)
        <li class="alert alert-danger">{{$error}}</li>
      @endforeach
    
      <div class="modal-body">
        {{ Form::hidden('listing_id', $details->id) }}
        <div class="form-group">
          {!! Form::label('Reply to email address?') !!}
          {!! Form::text('email', $user->email, [ 'class'=>'form-control', 'placeholder'=>'Enter contact e-mail address']) !!}
        </div>
        
        <div class="form-group">
          {!! Form::label('Message:')!!}
          {!! Form::textarea('message', null, [ 'class'=>'form-control', 'placeholder'=>'Enter message.'])!!}
        </div>
      </div>

      <div class="modal-footer">
        {!! Form::submit('Send email', ['class'=>'btn btn-orange form-control']) !!}
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    {!! Form::close() !!}

    </div>
  </div>

@endif


@endsection

  @section('additionalCss')
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
  @endsection
  @section('additionalJs')
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
  

  <script>

  $(document).ready(function(){

    $('.images-slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        autoplay: false,
        arrows: true,
        prevArrow: '<div class="slick-prev"><i class="fa fa-chevron-left"></i></div>',
        nextArrow: '<div class="slick-next"><i class="fa fa-chevron-right"></i></div>'
      });
    });


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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GMAPS_API_KEY')}}&callback=initMap"></script>
  
@endsection
