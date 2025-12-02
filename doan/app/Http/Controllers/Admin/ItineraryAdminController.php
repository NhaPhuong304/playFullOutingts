<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use Illuminate\Http\Request;

class ItineraryAdminController extends Controller
{
    public function itineraries()
    {
        $itineraries = Itinerary::where('is_delete', 0)->get();
        return view('admin.itineraries', compact('itineraries'));
    }

    public function add(Request $request)
    {
        Itinerary::create([
            'name' => $request->name,
            'description' => $request->description,
            'days' => $request->days,
            'status' => $request->status,
        ]);

        return back()->with('success', 'Thêm chuyến đi thành công!');
    }

    public function show($id)
    {
        $itinerary = Itinerary::with('locations')->findOrFail($id);
        return response()->json($itinerary);
    }

    public function update(Request $request, $id)
    {
        $itinerary = Itinerary::findOrFail($id);
        $itinerary->update($request->all());

        return back()->with('success', 'Cập nhật chuyến đi thành công!');
    }

    public function delete($id)
    {
        Itinerary::where('id', $id)->update(['is_delete' => 1]);
        return back()->with('success', 'Đã xóa chuyến đi');
    }
}
