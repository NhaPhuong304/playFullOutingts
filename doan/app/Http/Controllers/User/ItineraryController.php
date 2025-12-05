<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function itinerary(){
        $data = [
            'itinerary' => Itinerary::all(),
            'locations' => \App\Models\Location::where('is_delete', 0)->orderBy('id', 'desc')->get(),

        ];
        return view('user/itinerary', $data);
    }
    
}
