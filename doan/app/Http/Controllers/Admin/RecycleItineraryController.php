<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Itinerary;


class RecycleItineraryController extends Controller

{
    public function trash()
    {
        $itineraries = Itinerary::where('is_delete', 1)->get();
        return view('admin.trashItineraries', compact('itineraries'));
    }

    public function restore($id)
    {
        Itinerary::where('id', $id)->update(['is_delete' => 0]);
        return back()->with('success', 'Restore Itinerary Sussess!');
    }

    public function delete($id)
    {
        Itinerary::where('id', $id)->delete();
        return back()->with('success', 'Delete Itinerary Sussess!');
    }
        
}
