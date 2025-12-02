<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    // Hiển thị danh sách Material
    public function material()
    {
        $materials = Material::all();
        $games = Game::all();
        return view('admin.material', compact('materials', 'games'));
    }

    // Thêm Material mới
    public function add(Request $request)
    {
        $request->validate([
            'material' => 'required|string|max:255|unique:game_materials,material',
        ]);

        Material::create([
            'material' => $request->material
        ]);

        return response()->json(['success' => true, 'message' => 'Material added successfully']);
    }

    // Cập nhật Material
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'material' => 'required|string|max:255|unique:game_materials,material,' . $material->id,
        ]);

        $material->update([
            'material' => $request->material
        ]);

        return response()->json(['success' => true, 'message' => 'Material updated successfully']);
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json(['success' => true, 'message' => 'Material deleted successfully']);
    }
}
