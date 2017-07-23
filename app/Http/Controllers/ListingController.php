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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');;
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
        if (!$details = Listing::find($id)) {
            abort(404, 'Doomed');
        }
        return view('listing-details', compact('details'));
    }
}
