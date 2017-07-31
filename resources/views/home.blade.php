@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="wrapper">

                <h1>Stay in Skopje. 🛏 It’s FREE. </h1>
                <h2 class="text-black">Motivated by the recent booking scandal in Skopje, the WeTalkIT community decided to prove that this town can be hospitable as well. This is a website created to offer free tourist accommodation in Skopje for the upcoming UEFA Super Cup 2017.</h1>

                <div class="dropdown-holder row">
                    
                {{ Form::open(['url' => '/', 'method' => 'GET']) }}

                    <div class="col-lg-3 col-sm-3">
                        <label>When</label>
                        <input name="daterange" class="form-control" type="text" placeholder="Anytime" value="{!! @$inputs['daterange'] !!}" date-from="{!! @$inputs['dates'][0] !!}" date-to="{!! @$inputs['dates'][1] !!}"/>
                    </div>

                   <div class="dropdown col-lg-3 col-sm-3">
                        <label class="lbl">Beds</label>
                        <select name="beds" class="selectpicker" title="Number of Beds" id="beds">
                            <option value=""></option>
                            @foreach($bedsSelect as $bed)
                                <option value="{!! $bed !!}" {!! (isset($inputs['beds']) && $inputs['beds']==$bed) ? 'selected' : '' !!}>{!! $bed !!}</option>
                            @endforeach
                        </select>
                    </div>

                   <div class="dropdown col-lg-3 col-sm-3">
                        <label class="lbl">Guests</label>
                        <select name="people" class="selectpicker" title="Number of guests" id="people">
                            <option value=""></option>
                            @foreach($peopleSelect as $people)
                                <option value="{!! $people !!}" {!! (isset($inputs['people']) && $inputs['people']==$people) ? 'selected' : '' !!}>{!! $people !!}</option>
                            @endforeach
                        </select>
                   </div>

                    <div class="btn-holder col-lg-3 col-sm-3">
                        <label>&nbsp;</label>
                        <button class="btn btn-primary btn-find">Find</button>
                    </div> 

                {!! Form::close() !!}

                </div> <!-- dropdown holder -->
            </div> <!-- wrapper -->
        </div>
    </section>
    <section class="featured-in container">
        <div class="row">
            <div class="col-md-3">
            <h1 class="title-heading featured-title">
                <strong>Featured in:</strong>
            </h1>
            </div>
            <div class="col-md-3"><a href="https://techcrunch.com/2017/07/31/balkan-startups-offer-free-housing-service-after-football-price-gouging-row/" target="_blank"><img src="/images/tc-logo.svg" class="featured" style="max-height:50px"/></a></div>
            <div class="col-md-3 first-img"><a href="http://www.balkaninsight.com/en/article/macedonians-offer-free-lodging-for-uefa-super-cup-07-18-2017" target="_blank"><img src="/images/BalkanInsight.jpg" width="150" height="150" class="featured"/></a></div>
            <div class="col-md-3 third-img"><a href="https://globalvoices.org/2017/07/27/in-macedonia-geeks-create-free-accommodation-platform-in-reaction-to-hotel-price-hike-for-super-cup-fans/" target="_blank"><img src="/images/Logo-GlobalVoices.png" width="150" height="150" class="featured" /></a></div>
        </div>

    </section>

    <section class="active-places container">
        <div class="row">
            <h1 class="title-heading">
                <strong>Active Places</strong>
            </h1>
        </div>

        <div class="row" id="listing-container"></div>

        <div class="row">
            <div class="loading">
                <svg class="lds-comets" width="25px"  height="25px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
                <g transform="rotate(7.44241 50 50)">
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" values="360 50 50;240 50 50;120 50 50;0 50 50" keyTimes="0;0.333;0.667;1" dur="2s" keySplines="0.7 0 0.3 1;0.7 0 0.3 1;0.7 0 0.3 1" calcMode="spline"></animateTransform>
                    <path fill="#e25626" d="M91,74.1C75.6,98,40.7,102.4,21.2,81c11,9.9,26.8,13.5,40.8,8.7c7.4-2.5,13.9-7.2,18.7-13.3 c1.8-2.3,3.5-7.6,6.7-8C90.5,67.9,92.7,71.5,91,74.1z"></path>
                    <path fill="#e25626" d="M50.7,5c-4,0.2-4.9,5.9-1.1,7.3c1.8,0.6,4.1,0.1,5.9,0.3c2.1,0.1,4.3,0.5,6.4,0.9c5.8,1.4,11.3,4,16,7.8 C89.8,31.1,95.2,47,92,62c4.2-13.1,1.6-27.5-6.4-38.7c-3.4-4.7-7.8-8.7-12.7-11.7C66.6,7.8,58.2,4.6,50.7,5z"></path>
                    <path fill="#e25626" d="M30.9,13.4C12,22.7,2.1,44.2,7.6,64.8c0.8,3.2,3.8,14.9,9.3,10.5c2.4-2,1.1-4.4-0.2-6.6 c-1.7-3-3.1-6.2-4-9.5C10.6,51,11.1,41.9,14.4,34c4.7-11.5,14.1-19.7,25.8-23.8C37,11,33.9,11.9,30.9,13.4z"></path>
                </g>
                </svg> 
                <label>Loading...</label>
            </div>
            <p id="no-listings" style="display: none;">There aren't any available listings at the moment. Please check back later.</p>
            <p id="listing-end" style="display: none;">It seems you've reached the end. Change the filters or try again later.</p>

            <button class="btn btn-orange-inverse" id="load-more">Load More</button>
        </div>
    </section>

@endsection

@section('additionalJs')
<script type="text/javascript">
var listingUrl = '{{route("listing.list")}}';
var pageNumber = 1;
var articles;

function loadListings() {
    $("#load-more").hide();
    $(".loading").show();
    var ajaxData = {
        "daterange": $("input[name^='daterange']").val(),
        "beds": $("#beds :selected").val(),
        "people": $("#people :selected").val()
    };

    $.ajax({
        type : 'GET',
        url: listingUrl + '?page=' + pageNumber,
        data: ajaxData,
        success : function(response) {
            $("#load-more").show();
            $(".loading").hide();

            pageNumber += 1;
            
            var listingsObject = response.listings;
            if (listingsObject.current_page == listingsObject.last_page || listingsObject.data.length == 0) {
                $("#load-more").hide();
                if (pageNumber == 1) {
                    $("#no-listings").show();
                } else {
                    $("#listing-end").show();
                }
            }

            if (listingsObject.data.length) {
                listingsObject.data.forEach(function(elem) {
                    $("#listing-container").append($(elem.view));
                });
            }
        }, 
        error: function(data) {
                                                      
        }
    });
}

loadListings();

$(document).ready(function() {
    $(".featured").addClass('hover-class');
    $( ".featured" ).hover(
      function() {
        $( this ).removeClass( "hover-class" );
      }, function() {
        $( this ).addClass( "hover-class" );
      }
    );
    $("#load-more").click(function(){

        loadListings();

    });
});
</script>
@endsection