<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;


class ItineraryController extends Controller
{
    public function itinerary(){
        return view('user/itinerary');
    }
    public function detailItinerary(){
        return view('user/detailItinerary');
    }

}