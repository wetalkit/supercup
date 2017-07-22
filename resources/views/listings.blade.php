<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>Listings</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>

    <div class="container" style="display: inline-flex;">
    <!-- <input type="text" name="datefilter" value="" /> -->

<form action="{{ url('listing') }}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group">
  <input type="text" name="from" class="form-control" value="2017-07-22">
</div>
<div class="form-group">

  <input type="text" name="to" class="form-control" value="2017-07-25">
</div>

  <label for="sel1">Number of Guests:</label>
  <select name="guests" class="form-control">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>

  <label for="sel1">Distance(km):</label>
  <select name="distance" class="form-control">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    <option>6</option>
    <option>7</option>
  </select>

    <button type="submit" class="btn btn-danger" style="margin-top: 10px">Find</button>

</form>
</div>

    <div class="card-group" style="display: inline-flex;">

        @foreach ($listings as $listing)

    @php
        $name = $listing['title'];
        $description = $listing['description'];
        $motiv = $listing['motiv'];
        $bedNum = $listing['no_beds'];
        $people = $listing['no_people'];
        $latitude = $listing['lat'];
        $longitude = $listing['lng'];
        $distance_stadium_time = $listing['distance_stadium_time'];
        $distance_stadium = $listing['distance_stadium'];

    @endphp

    <div class="card" style="  border-style: solid; border-width: 2px; width: 300px; margin-top: 10px; margin-left: 10px">
        <img class="card-img-top" src="house.jpg" alt="Card image cap">
        <div class="card-block">
            <h4 class="card-title">{{$name}}</h4>
            <p class="card-text">Description: {{$description}}</p>
            <p class="card-text">Motiv: {{$motiv}}</p>
            <p class="card-text">Beds: {{$bedNum}}</p>
            <p class="card-text">People: {{$people}}</p>
            <p class="card-text">latitude: {{$latitude}}</p>
            <p class="card-text">longitude: {{$longitude}}</p>
            <p class="card-text">Seconds: {{$distance_stadium_time}}</p>
            <p class="card-text">Meters: {{$distance_stadium}}</p>

              <button type="button" class="btn btn-danger">Book Now</button>
        </div>
    </div>

        @endforeach
    </div>

    </body>

</html>
