@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="wrapper">

                <h1>Stay in Skopje. For FREE.</h1>
                <h2 class="text-black">Motivated by the recent booking scandal in Skopje, the WeTalkIT community decided to prove that this town can be hospitable as well. This is a website created to offer free tourist accommodation in Skopje for the upcoming UEFA Super Cup 2017.</h1>

                <div class="dropdown-holder row">
                    
                {{ Form::open(['url' => '/', 'method' => 'GET']) }}

                    <div class="col-lg-3 col-sm-6">
                        <label>When</label>
                        <input name="daterange" class="form-control" type="text" placeholder="Anytime" />
                    </div>

                   <div class="dropdown col-lg-3 col-sm-6">
                        <label>Beds</label>
                        <select name="number_beds" class="selectpicker" title="Number of Beds">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>

                   <div class="dropdown col-lg-3 col-sm-6">
                        <label>Distance</label>
                        <select name="distance" class="selectpicker" title="Distance">
                            <option>< 1</option>
                            <option>< 2</option>
                        </select>
                   </div>

                    <div class="btn-holder col-lg-3 col-sm-6">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary btn-find">Find</button>
                    </div> 

                {!! Form::close() !!}

                </div> <!-- dropdown holder -->
            </div> <!-- wrapper -->
        </div>
    </section>

    <section class="active-places container">
        <div class="row">
            <h1 class="title-heading">
                <strong>Active Places</strong>
            </h1>

            @if(!$listings->count())
            <p>There aren't any available listings at the moment. Please check back later.</p>
            @endif 

            @foreach($listings as $listing)

              <a href="{{ route('listing.show', $listing->id) }}" class="link-item">
                  <div class="col-md-4 col-sm-6">
                    <div class="gallery-section">
                      @foreach($listing->pictures as $image)
                        <img src="{!! route('storage', $image->picture) !!}" alt={!! $image->title !!}>
                      @endforeach
                    </div>
                    <h3 class="listing-author">by {!! $listing->user->name !!}</h3>
                    <span class="distance">{!! $listing->distance_stadium_time !!} mins distance</span>
                    <span>-</span>
                    <span class="nr-of-beds">{!! $listing->no_beds !!} beds</span>
                  </div>
              </a>

            @endforeach

        </div>
    </section>

@endsection
