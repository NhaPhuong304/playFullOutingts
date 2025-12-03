<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class ItineraryAdminController extends Controller
{
    public function itinerary()
    {
        $itineraries = Itinerary::where('is_delete', 0)->orderBy('id', 'desc')->get();
        return view('admin.itineraries', compact('itineraries'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:itineraries,name',
            'description' => 'nullable|string',
            'days' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        Itinerary::create([
            'name' => $request->name,
            'description' => $request->description,
            'days' => $request->days,
            'status' => $request->status,
            'is_delete' => 0,
        ]);

        return back()->with('success', 'Added itinerary successfully!');
    }

    public function update(Request $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:itineraries,name,' . $id,
            'description' => 'nullable|string',
            'days' => 'nullable|integer',
            'status' => 'required|in:0,1',
        ]);

        $itinerary->update([
            'name' => $request->name,
            'description' => $request->description,
            'days' => $request->days,
            'status' => $request->status,
        ]);

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
