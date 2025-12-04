<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function itinerary(){
        $data = [
            'itinerary' => Itinerary::all()
        ];
        return view('user/itinerary', $data);
    }
    
}
