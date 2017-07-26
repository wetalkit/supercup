<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bedsSelect = [1,2];
        $peopleSelect = [1,2];

        $inputs = $request->all();

        $listings = Listing::where('terms_accepted', 1)->orderBy('distance_stadium', 'asc');

        if (array_key_exists('beds', $inputs) && $inputs['beds']) {
            $listings->where('no_beds', $inputs['beds']);
        }

        if (array_key_exists('people', $inputs) && $inputs['people']) {
            $listings->where('no_people', $inputs['people']);
        }

        if (array_key_exists('daterange', $inputs) && $inputs['daterange']) {
            $inputs['dates'] = explode(' - ', $inputs['daterange']);
            $dateFrom = Carbon::createFromFormat('d M Y H:i:s', trim($inputs['dates'][0]).' 2017 23:59:29');
            $dateTo = Carbon::createFromFormat('d M Y H:i:s', trim($inputs['dates'][1]).' 2017 00:00:00');

            $listings->where('date_from', '<=', $dateFrom);
            $listings->where('date_to', '>=', $dateTo);
        }
        
        $listings = $listings->paginate(2);

        return view('home', compact('listings', 'inputs', 'bedsSelect', 'peopleSelect'));
    }

    /**
     * Lists and paginates the listings.
     * 
     * @return JSON
     */
    public function listListings(Request $request)
    {
        $inputs = $request->all();
        $listings = Listing::where('terms_accepted', 1)->orderBy('id', 'desc');

        if (array_key_exists('beds', $inputs) && $inputs['beds']) {
            $listings->where('no_beds', $inputs['beds']);
        }

        if (array_key_exists('people', $inputs) && $inputs['people']) {
            $listings->where('no_people', $inputs['people']);
        }

        if (array_key_exists('daterange', $inputs) && $inputs['daterange']) {
            $inputs['dates'] = explode(' - ', $inputs['daterange']);
            $dateFrom = Carbon::createFromFormat('d M Y H:i:s', trim($inputs['dates'][0]).' 2017 23:59:29');
            $dateTo = Carbon::createFromFormat('d M Y H:i:s', trim($inputs['dates'][1]).' 2017 00:00:00');

            $listings->where('date_from', '<=', $dateFrom);
            $listings->where('date_to', '>=', $dateTo);
        }
        
        $listings = $listings->paginate(3);

        foreach ($listings as $listing) {
            $listing->view = view('partials.listing', compact('listing'))->render();
        }

        return response()->json(compact('listings'));
    }

    /**
     * Faq page
     * 
     * @return view
     */
    public function faq()
    {
        return view('faq');
    }

    /**
     * About page
     * 
     * @return view
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Privacy page
     * 
     * @return view
     */
    public function privacy()
    {
        return view('privacy');
    }

    /**
     * Report a bug page
     * 
     * @return view
     */
    public function bug()
    {
        return view('bug');
    }
}
