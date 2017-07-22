<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Listings</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
    
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
        </div>
    </div>

        @endforeach
    </div>

    </body>
</html>
