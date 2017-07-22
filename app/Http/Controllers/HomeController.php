<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $test = Location::calculateWalkingDistance('40.858449', '21.4235062');

        var_dump($test);
        exit;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
}
