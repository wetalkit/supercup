<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;

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

        $listings = Listing::all();

        return view('home', compact('listings'));
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
}
