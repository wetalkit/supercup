@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="wrapper">

                <h1>Stay in Skopje. For FREE.</h1>
                <h2 class="text-black">Motivated by the recent booking scandal in Skopje, the WeTalkIT community decided to prove that this town can be hospitable as well. This is a website created to offer free tourist accommodation in Skopje for the upcoming UEFA Super Cup 2017.</h1>

                <div class="dropdown-holder row">
                    <!-- Large button groups (default and split) -->
                    <div class="col-lg-3 col-sm-6">
                      <input class="form-control" type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
                    </div>

                   <div class="dropdown col-lg-3 col-sm-6">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Number of Beds
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                      </ul>
                    </div>

                    <div class="dropdown col-lg-3 col-sm-6">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Distance
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a href="#">&lt; 500m</a></li>
                        <li><a href="#">&lt; 500m</a></li>
                        <li><a href="#">&lt; 500m</a></li>
                      </ul>
                    </div> <!-- dropdown -->

                    <div class="btn-holder col-lg-3 col-sm-6">
                        <button class="btn btn-primary btn-find">Find</button>
                    </div> 

                </div> <!-- dropdown holder -->
            </div> <!-- wrapper -->
        </div>
    </section>

    <section class="active-places container">
        <div class="row">
            <h1 class="title-heading">
                <strong>Active Places</strong>
            </h1>

            <a href="single-listing.html" class="link-item">
                <div class="col-md-4 col-sm-6">
                    <img src="https://placeholdit.co//i/350x300?&bg=grey">
                        <h3 class="listing-author">by Anita Kirkovska</h3>
                        <span class="distance">100m-200m distance -</span>
                        <span class="nr-of-beds">2 beds</span>
                </div>
            </a>

            <a href="single-listing.html" class="link-item">
                <div class="col-md-4 col-sm-6">
                    <img src="https://placeholdit.co//i/350x300?&bg=grey">
                        <h3 class="listing-author">by Anita Kirkovska</h3>
                        <span class="distance">100m-200m distance -</span>
                        <span class="nr-of-beds">2 beds</span>
                </div>
            </a>

            <a href="single-listing.html" class="link-item">
                <div class="col-md-4 col-sm-6">
                    <img src="https://placeholdit.co//i/350x300?&bg=grey">
                        <h3 class="listing-author">by Anita Kirkovska</h3>
                        <span class="distance">100m-200m distance -</span>
                        <span class="nr-of-beds">2 beds</span>
                </div>
            </a>


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
