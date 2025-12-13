<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;


class ItineraryController extends Controller
{
    public function itinerary(){
        $data = [
            'itineraries' => Itinerary::with('locations.categoryLocations')->orderBy('id', 'desc')->get(),
            'categories' => \App\Models\CategoryLocation::where('is_delete', 0)->orderBy('id', 'desc')->get(),
        ];
        return view('user.itinerary', $data);
    }


    public function itineraryDetail($id)
    {
        $itinerary = Itinerary::with('locations')->findOrFail($id);

        // Lấy danh sách location thuộc itinerary
        $locations = $itinerary->locations;

        return view('user.detailItinerary', compact('itinerary', 'locations'));
    }

}
