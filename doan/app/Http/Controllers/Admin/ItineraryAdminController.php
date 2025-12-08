<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\Location;
use Illuminate\Http\Request;

class ItineraryAdminController extends Controller
{
    public function itinerary()
    {
        $itineraries = Itinerary::where('is_delete', 0)->orderBy('id', 'desc')->get();
        $locations = Location::where('status', 1)->get();
        return view('admin.itineraries', compact('itineraries', 'locations'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:itineraries,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'days' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);
        $imageName = null;
                if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $imageName = time().'_'.$file->getClientOriginalName();
                    $file->move(public_path('storage/itineraries'), $imageName);
                }

        $itinerary = Itinerary::create([
        'name' => $request->name,
        'description' => $request->description,
        'days' => $request->days,
        'status' => $request->status,
        'image' => $imageName
    ]);

    $itinerary->locations()->sync($request->location_ids);


        return back()->with('success', 'Added itinerary successfully!');
    }

    public function update(Request $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:itineraries,name,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'days' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $itinerary->update([
            'name' => $request->name,
            'image' => $request->image,
            'description' => $request->description,
            'days' => $request->days,
            'status' => $request->status,
        ]);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/itineraries'), $imageName);
            $itinerary->update(['image' => $imageName]);
        }   
$itinerary->locations()->sync($request->location_ids);


        return back()->with('success', 'Updated itinerary successfully!');
    }

    public function delete($id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->update([
            'is_delete' => 1,
            'status' => 0
        ]);

        return back()->with('success', 'Deleted itinerary successfully!');
    }
}
