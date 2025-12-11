<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Material;
use Illuminate\Support\Facades\Storage;

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
        'name' => 'required|string|max:255|unique:games,name',
        'slug' => 'required|string|max:255|unique:games,slug',
        'duration' => 'nullable|integer',
        'instructions' => 'nullable|string',
        'status' => 'required|boolean',
        'categories' => 'nullable|array',
        'players' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'download_file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        'video_url' => 'nullable|url'
    ]);

    $game = new Game();
    $game->name = $request->name;
    $game->slug = $request->slug;
    $game->duration = $request->duration;
    $game->instructions = $request->instructions;
    $game->players = $request->players;
    $game->difficulty = $request->difficulty;
    $game->game_setup = $request->game_setup;
    $game->game_rules = $request->game_rules;
    $game->status = $request->status;
    $game->video_url = $request->video_url ?? null;


    // Image
    if($request->hasFile('image')){
        $filename = time().'_'.$request->image->getClientOriginalName();
       $request->image->move(public_path('storage/games/images'), $filename);
        $game->image = $filename;
    } else {
        $game->image = 'no-image.jpg';
    }

    if ($request->hasFile('download_file')) {

        // Xóa file cũ
        if ($game->download_file && Storage::exists('public/games/files/'.$game->download_file)) {
            Storage::delete('public/games/files/'.$game->download_file);
        }

        $file = $request->file('download_file');
        $fileName = time().'_'.$file->getClientOriginalName();
        $file->storeAs('public/games/files', $fileName);

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
        $game->players = $request->players;
        $game->game_setup = $request->game_setup;
        $game->game_rules = $request->game_rules;
        $game->instructions = $request->instructions;
        $game->difficulty = $request->difficulty;
        $game->status = $request->status;
        $game->video_url = $request->video_url;
        $game->download_file = $request->download_file;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/images'), $filename);
            $game->image = $filename;
        }

    if($request->hasFile('download_file')){
            $fileName = time().'_'.$request->download_file->getClientOriginalName();
            $request->download_file->move(public_path('storage/games/files'), $fileName);
            $game->download_file = $fileName;
        }
        $game->save();

        // Sync categories
         $game->categories()->sync($request->categories ?? []);
        $game->materials()->sync($request->materials ?? []);
    $game->video_url = $request->video_url ?? null;

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
