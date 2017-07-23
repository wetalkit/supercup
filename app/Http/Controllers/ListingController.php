<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ListingRequest;
use App\Http\Requests\BookRequest;
use Auth;
use App\User;
use App\Listing;
use App\ListingPictures;
use App\Helpers\Location;
use Carbon\Carbon;

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
        return view('new-listing');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingRequest $request)
    {
        $data = $this->prepareListing($request);
        $listing = Listing::create($data);
        $listing->user->update(['email' => $listing->contact_email]);
        $this->uploadPictures($request, $listing);
        return redirect()->route('listing.edit', [$listing->id, 'share' => 'y']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        if (!$listing) {
            abort(404, 'Doomed');
        }
        
        return view('listing-details', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {
        $bookers = [];
        foreach ($listing->contacts as $contact) {
            $bookers[$contact->sender_id] = $contact->booker->name;
        }
        return view('edit-listing', compact('listing', 'bookers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListingRequest $request, Listing $listing)
    {
        $data = $this->prepareListing($request);
        $listing->update($data);
        $listing->user->update(['email' => $listing->contact_email]);
        $imgs_delete = $request->imgs_delete ? explode(',',trim($request->imgs_delete, ',')) : [];
        foreach ((array)$imgs_delete as $image) {
            $listingPicture = ListingPictures::find($image);
            unlink(storage_path().'/app/'.$listingPicture->picture);
            $listingPicture->delete();
        } 
        if($request->pictures) {
            $this->uploadPictures($request, $listing);
        }
        $request->session()->flash('success', 'Your listing was successfully updated.');
        return redirect()->route('listing.edit', $listing->id);
    }

    private function prepareListing($request)
    {
        $data = $request->except(['pictures', 'daterange', 'imgs_delete']) + ['user_id' => Auth::user()->id];
        $daterange = explode('-', $request->get('daterange'));
        $data['date_from'] = Carbon::createFromFormat('d M Y', trim($daterange[0]).' 2017');
        $data['date_to'] = Carbon::createFromFormat('d M Y', trim($daterange[1]).' 2017');
        $distance = Location::calculateWalkingDistance($data['lat'], $data['lng']);
        $data['distance_stadium'] = $distance['distance'];
        $data['distance_stadium_time'] = $distance['time'];
        return $data;
    }

    private function uploadPictures($request, $listing)
    {
        $pictures = $request->file('pictures');
        foreach ($pictures as $picture) {
            $path = $picture->store('listing_pictures');
            ListingPictures::create([
                'picture' => $path,
                'listing_id' => $listing->id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Listing  $listing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        foreach ($listing->pictures as $picture) {
            unlink(storage_path().'/app/'.$picture->picture);
            $picture->delete();
        }
        $listing->delete();
        return redirect('/');
    }

    public function book(BookRequest $request, Listing $listing)
    {
        $listing->update(['status' => 1, 'booker_id' => $request->booker_id]);
        return redirect()->back();
    }
}
