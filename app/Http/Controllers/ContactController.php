<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ListingContact;
use Illuminate\Support\Facades\Auth;
use App\Events\ContactHost;
use App\Http\Requests\ListingContactRequest;
class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListingContactRequest $request)
    {
        $listing_id = $request->get('listing_id');
        $user_id = Auth::User()->id;
        $listingContact = new ListingContact();
        $listingContact->sender_id = $user_id;
        $listingContact->listing_id = $listing_id;
        // $listingContact->sender_id = Auth::User()->id;
        $listingContact->save();
        // event(new ContactHost($user, $listing));
    }
}
