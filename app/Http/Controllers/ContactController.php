<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListingContactRequest;
use Illuminate\Support\Facades\Auth;
use App\ListingContact;
use App\Listing;
use App\Events\ContactHost;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function fireMessage(ListingContactRequest $request)
    {
        if ($listing = Listing::find($request->get('listing_id'))) {
            $user = Auth::user();
            $listingContact = new ListingContact();
            $listingContact->sender_id = $user->id;
            $listingContact->listing_id = $listing->id;
            $listingContact->save();
            event(new ContactHost($user, $listing, $request->get('message')));
            return [
                'response' => true
            ];
        }
        
        return [
            'response' => false,
            'data' => ['Try again.']
        ];
    }
}
