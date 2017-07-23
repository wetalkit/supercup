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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        $user_id = 1;
        $listingContact = new ListingContact();
        $listingContact->sender_id = $user_id;
        $listingContact->listing_id = $listing_id;
        // $listingContact->sender_id = Auth::User()->id;
        $listingContact->save();
        // event(new ContactHost($user, $listing));
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
