<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Itinerary;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Hiển thị danh sách
    public function location()
    {
        $data = [
            'locations' => Location::where('is_delete', 0)->orderBy('id', 'desc')->get(),
            'itineraries' => Itinerary::where('is_delete', 0)->orderBy('id', 'desc')->get()
        ];
        return view('admin.locations')->with($data);
    }

    // Thêm location mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'itinerary_ids' => 'nullable|array',
            'itinerary_ids.*' => 'integer|exists:itineraries,id',
        ]);

        // Upload image nếu có
        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/locations'), $imageName);
        }

        // Tạo location
        $location = Location::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status ?? 1,
            'is_delete' => 0,
        ]);

        // Gán many-to-many
        if ($request->has('itinerary_ids')) {
            $location->itineraries()->sync($request->itinerary_ids);
        }

        return back()->with('success', 'Location added successfully!');
    }

    // Cập nhật location
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,'.$id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'itinerary_ids' => 'nullable|array',
            'itinerary_ids.*' => 'integer|exists:itineraries,id',
        ]);

        // Nếu có ảnh mới → upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/locations'), $imageName);
            $location->image = $imageName;
        }

        // Update thông tin
        $location->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        // Update many to many
        if ($request->has('itinerary_ids')) {
            $location->itineraries()->sync($request->itinerary_ids);
        } else {
            $location->itineraries()->sync([]); // Nếu không chọn itinerary thì xoá hết
        }

        return redirect()->back()->with('success', 'Location updated successfully!');
    }

    // Xóa mềm
    public function delete($id)
    {
        $location = Location::findOrFail($id);
        $location->update([
            'is_delete' => 1,
            'status' => 0
        ]);

        return back()->with('success', 'Location deleted successfully!');
    }
}
