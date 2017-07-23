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


    <section class="faq-section container">
        <h1 class="h1-faq"><strong>FAQ</strong></h1>

           <div class="faq-wrap">
               <div class="faq-single">
                   <h5 class="faq-title">
                       <strong>Is Skopje safe?</strong>
                   </h5>
                   <div class="faq-content">
                       <div class="faq-toggle">
                           <p>Skopje just might be safe enough to sleep in the streets (though we don't recommend it). There will be increased police presence for the UEFA Super Cup as well, so you have nothing to worry about. Also, most locals speak English and will come to your aid if you find yourself needing assistance.</p>
                       </div>
                   </div>
               </div>
               <div class="faq-single">
                   <h5 class="faq-title">
                       <strong>How do I get to Skopje from the airport?</strong>
                   </h5>
                   <div class="faq-content">
                       <div class="faq-toggle">
                           <p>Getting to Skopje from the airport is easy. The cheapest option is a bus that costs 3 euros. Cabs are always available right outside the airport and will take you to Skopje for 20 euros or less. You can also rent a car on spot but keep in mind that we drive on the right side of the road. ;)</p>
                       </div>
                   </div>
               </div>
               <div class="faq-single">
                   <h5 class="faq-title">
                       <strong>How do I get to the stadium?</strong>
                   </h5>
                   <div class="faq-content">
                       <div class="faq-toggle">
                           <p>Regardless of where you stay in Skopje, you will never be more than 8 km away from the Philip II Arena. Traffic is expected to be terrible on match day, however, cabs are relatively cheap and charge less than half an euro per kilometer. Your best bet will be to get to the city square early, relax, have a beer and walk the rest of the way.</p>
                       </div>
                   </div>
               </div>
         </div>

    </section>
@endsection
