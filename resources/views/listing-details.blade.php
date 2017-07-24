@extends('layouts.app')

@section('content')

<section class="listing">
    <div class="container">

      <div class="listing-details clearfix">

        <div class="heading clearfix">
          <div class="col-md-9 col-sm-9">
            <div class="title"><h2>{!! $listing->title !!}</h2></div>
            <div class="by">
              <label>by</label> 
              <div class="img" style="background-image: url('{!! $listing->user->fb_avatar !!}');"></div>
              <div class="name">
                  <a href="{!! $listing->user->fb_link !!}" target="_blank">{!! $listing->user->name !!}</a>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-3 cta">
            @if($listing->status)
              <span class="label label-success booked">Booked</span>
            @else
              @if($user)
                @if($user->id != $listing->user_id)
                  <button type="button" class="btn btn-orange btn-orange-inverse" data-toggle="modal"  data-target="#messageHost">Message Host</button>
                @else
                  <a type="button" class="btn btn-orange btn-orange-inverse" href="{{route('listing.edit', $listing->id)}}">Edit</a>
                @endif
              @else
                <button type="button" class="btn btn-orange btn-orange-inverse" data-toggle="modal"  data-target="#loginModal">Message Host</button>
              @endif
            @endif
          </div>
        </div>
        <hr/>
          
        <div class="col-md-6 col-sm-6">

          <div class="images-slider">
            @if(count($listing->pictures) == 0)
              <img src="/images/imagena.jpg" alt="{!! $listing->title !!}"/>
            @endif
            @foreach($listing->pictures as $picture) 
              <img src="{{route('storage', $picture->picture)}}" alt="{!! $listing->title !!}"/>
            @endforeach
          </div>

        </div>

        <div class="col-md-6 col-sm-6">
          <div class="details">
            <h5>Description:</h5>
            <p>{!! $listing->description !!}</p>

            <h5>Distance from stadium:</h5>
            <p>{!! $listing->distanceFormatted !!}</p>

            <h5>Number of beds:</h5>
            <p>{!! $listing->no_beds !!}</p>

             <h5>Number of people:</h5>
            <p>{!! $listing->no_people !!}</p>

            <h5>Available:</h5>
            <p>From <span>{!! $listing->dateFromFormatted !!}</span> to <span>{!! $listing->dateToFormatted !!}</span></p>
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
    
  {!! Form::open(['route' => 'contact.fireMessage', 'method' => 'POST','class' => 'form', 'id'=>'contact-host']) !!}

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Message {!! $listing->user->name !!}</h4>
    </div>
    
    <div class="modal-body">
      {{ Form::hidden('listing_id', $listing->id) }}

      <div class="message-aler-holder"></div>

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

    bootstrap_alert = function() {}
    bootstrap_alert.warning = function(message) {
        $('.message-aler-holder').html('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><span>'+message+'</span></div>')
    }

    $('#contact-host').submit(function(e) {

        var url = $(this).attr('action');
        var type = 'POST';

        $.ajax({
          type: type,
          url: url,
          dataType: 'json',
         data: $(this).serialize(),
        }).done(function(data) {
            
            $('#messageHost').modal('hide');
            alert('Your message was sent successfully!');
        
        }).fail(function (response) {
        
            var data = response.responseJSON;
            if(!data.response){
              bootstrap_alert.warning(data.data.join('<br/>'));
            }
        
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    
    });

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

    var citymap = {
      destination: {
        center: {lat: {{$listing->lat}}, lng: {{$listing->lng}}},
        population: 5
      },
    };

    function initMap() {
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: {lat: {{$listing->lat}}, lng: {{$listing->lng}} },
      });

      for (var city in citymap) {
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
