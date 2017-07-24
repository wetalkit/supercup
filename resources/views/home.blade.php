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
                        <input name="daterange" class="form-control" type="text" placeholder="Anytime" value="{!! @$inputs['daterange'] !!}" date-from="{!! @$inputs['dates'][0] !!}" date-to="{!! @$inputs['dates'][1] !!}"/>
                    </div>

                   <div class="dropdown col-lg-3 col-sm-6">
                        <label>Beds</label>
                        <select name="beds" class="selectpicker" title="Number of Beds">
                            @foreach($bedsSelect as $bed)
                                <option value="{!! $bed !!}" {!! (isset($inputs['beds']) && $inputs['beds']==$bed) ? 'selected' : '' !!}>{!! $bed !!}</option>
                            @endforeach
                        </select>
                    </div>

                   <div class="dropdown col-lg-3 col-sm-6">
                        <label>People</label>
                        <select name="people" class="selectpicker" title="Number of People">
                            @foreach($peopleSelect as $people)
                                <option value="{!! $people !!}" {!! (isset($inputs['people']) && $inputs['people']==$people) ? 'selected' : '' !!}>{!! $people !!}</option>
                            @endforeach
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
                    <div class="gallery-section {{$listing->status ? 'booked' : ''}}">
                        <img src="{!! route('storage', $listing->defaultImageSrc) !!}" alt={!! $listing->title !!}>
                        <span class="label label-booked">Booked</span>
                    </div>
                    <h3 class="listing-author">by {!! $listing->user->name !!}</h3>
                    <span class="distance">{!! $listing->distanceFormatted !!}</span>
                    <span>-</span>
                    <span class="nr-of-beds">{!! $listing->no_beds !!} beds</span>
                  </div>
              </a>

            @endforeach

        </div>
    </section>

@endsection
