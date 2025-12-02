<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Material;

class GameController extends Controller
{
        public function game()
    {
        $games = Game::with('categories','materials')->orderBy('id','desc')->where('status', '1')->get();
        $categories = Category::all();
        $materials = Material::all();
        return view('admin.game', compact('games','categories','materials'));
    }

   public function add(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:games,slug',
        'duration' => 'nullable|integer',
        'instructions' => 'nullable|string',
        'status' => 'required|boolean',
        'categories' => 'nullable|array',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'download_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        'video_url' => 'nullable|url'
    ]);

    $game = new Game();
    $game->name = $request->name;
    $game->slug = $request->slug;
    $game->duration = $request->duration;
    $game->instructions = $request->instructions;
    $game->status = $request->status;

    // Image
    if($request->hasFile('image')){
        $filename = time().'_'.$request->image->getClientOriginalName();
        $request->image->storeAs('public/games/images', $filename);
        $game->image = $filename;
    } else {
        $game->image = 'no-image.jpg';
    }

    // File
    if($request->hasFile('download_file')){
        $fileName = time().'_'.$request->download_file->getClientOriginalName();
        $request->download_file->storeAs('public/games/files', $fileName);
        $game->download_file = $fileName;
    }

    // Video
    $game->video_url = $request->video_url ?? null;

    $game->save();

    // Categories
    $game->categories()->sync($request->categories ?? []);
    $game->materials()->sync($request->materials ?? []);

    return redirect()->back()->with('success', 'Game added successfully');
}


    // Update game
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $game->name = $request->name;
        $game->slug = $request->slug;
        $game->duration = $request->duration;
        $game->instructions = $request->instructions;
        $game->status = $request->status;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/images'), $filename);
            $game->image = $filename;
        }

        $game->save();

        // Sync categories
         $game->categories()->sync($request->categories ?? []);
        $game->materials()->sync($request->materials ?? []);

        return redirect()->back()->with('success', 'Game updated successfully.');
    }



    // Xóa game (soft delete)
    public function delete($id)
    {
        $game = Game::findOrFail($id);
        $game->is_delete = 1;
        $game->status = 0;
        $game->save();

        return redirect()->back()->with('success', 'Game deleted successfully!');
    }
}
