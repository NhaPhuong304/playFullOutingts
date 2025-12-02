<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function location(Request $request)
    {
        $search = $request->input('search');

        $locations = Location::with('itinerary')
            ->where('is_delete', 0)
            ->get();
        $itineraries = Itinerary::where('status',1)->get();
        return view('admin.locations', compact('locations','search','itineraries'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'itinerary_id' => 'required|exists:itineraries,id',
            'name' => 'required',
        ]);

        Location::create($request->all());
        return response()->json(['success' => true]);
    }

    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->update(['is_delete' => 1]);

        return response()->json(['success' => true]);
    }
}
