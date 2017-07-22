<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       $stadiumLat = 42.0057531;
       $stadiumLon = 21.4235062;

       $listings = Listing::all();

       foreach ($listings as $listing) {
            if ($listing->distance_stadium == 0.0){
               $destination = $this->getWalkingDistance($stadiumLat, $listing->lat,$stadiumLon, $listing->lng);
               $listing->distance_stadium =  $destination["distance"];
               $listing->distance_stadium_time = $destination["time"];
               $listing->save();
            }
        }

       return view('listings', compact('listings'));
    }

function getWalkingDistance($lat1, $lat2, $long1, $long2)
{
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=walking";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['value'];
    $d = $response_a['rows'][0]['elements'];
    return array('distance' => $dist, 'time' => $time);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "CREATE";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
