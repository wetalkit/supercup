<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Http\Requests\ListingRequest;
use App\Listing;
use App\ListingPictures;
use Auth;
use App\Helpers\Location;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        return redirect('/');

       //  $from = $request->input('from');
       //  $to = $request->input('to');
       //  $guests = $request->input('guests');
       //  $distance = $request->input('distance');

       //  $start = date("Y-m-d",strtotime($from));
       //  $end = date("Y-m-d",strtotime($to));

       //  $listings = Listing::whereBetween('date_from', [$start, $end])->get()->where('distance_stadium','<=', $distance*1000)->where('no_people','==', $guests);

       // return view('listings', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new_listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $data = $request->except(['pictures']) + ['user_id' => Auth::user()->id];
        $data = $data + [
            'lat' => 0, 'lng' => 0, 'distance_stadium' => 0, 'distance_stadium_time' => 0
        ];
        $listing = Listing::create($data);
        $pictures = $request->file('pictures');
        foreach ($pictures as $picture) {
            $path = $picture->store('listing_pictures');
            ListingPictures::create([
                'picture' => $path,
                'listing_id' => $listing->id
            ]);
        }
        return redirect()->route('listing.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $details = Listing::find($id);
        $user = User::find($details->user_id);
        return view('listing-details', compact('details', 'user'));
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