<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CategoryLocation;
use App\Models\Location;

class RecycleCategoryLocationController extends Controller

{
    public function trash()
    {
        $categoryLocations = CategoryLocation::where('is_delete', 1)->get();
        return view('admin.trashCategoryLocation', compact('categoryLocations'));
    }

    public function restore($id)
    {
        CategoryLocation::where('id', $id)->update(['is_delete' => 0]);
        return back()->with('success', 'Restored successfully!');
    }

     public function delete($id)
    {
        $categoryLocation = CategoryLocation::with('itineraries')->findOrFail($id);

        if ($categoryLocation->itineraries->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete category location because it has associated itineraries.');
        }

        $categoryLocation->delete();
        return redirect()->back()->with('success', 'Category location deleted successfully.');
    }
        
}
