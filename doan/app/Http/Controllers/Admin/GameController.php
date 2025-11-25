<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Str;

class GameController extends Controller
{
    // Hiển thị danh sách games
    public function game()
    {
        $games = Game::orderBy('id', 'desc')->get();
        return view('admin.game', compact('games'));
    }

    // Thêm game mới
    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|max:5120',
            'video_url' => 'nullable|mimes:mp4,mov,avi|max:102400',
            'download_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'duration' => 'nullable|integer',
            'instructions' => 'nullable|string',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->slug = Str::slug($request->name);

        // Upload Image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/images'), $filename);
            $game->image = $filename;
        }

        // Upload Video

            if ($request->hasFile('video_url')) {
                $file = $request->file('video_url');
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('storage/games/videos'), $filename);
                $game->video_url = $filename; // lưu tên file vào DB
            }


        // Upload File
        if ($request->hasFile('download_file')) {
            $file = $request->file('download_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/files'), $filename);
            $game->download_file = $filename;
        }

        $game->duration = $request->duration;
        $game->instructions = $request->instructions;
        $game->status = 1;
        $game->is_delete = 0;

        $game->save();

        return redirect()->back()->with('success', 'Game created successfully!');
    }

    // Update game
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
            'video_url' => 'nullable|mimes:mp4,mov,avi|max:102400',
            'download_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'duration' => 'nullable|integer',
            'instructions' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $game->name = $request->name;
        $game->slug = Str::slug($request->name);
        $game->duration = $request->duration;
        $game->instructions = $request->instructions;
        $game->status = $request->status;

        // Update Image
        if ($request->hasFile('image')) {
            if ($game->image && file_exists(public_path('storage/games/images/'.$game->image))) {
                unlink(public_path('storage/games/images/'.$game->image));
            }
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/images'), $filename);
            $game->image = $filename;
        }

        // Update Video
        if ($request->hasFile('video_url')) {
            if ($game->video_url && file_exists(public_path('storage/games/videos/'.$game->video_url))) {
                unlink(public_path('storage/games/videos/'.$game->video_url));
            }
            $file = $request->file('video_url');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/videos'), $filename);
            $game->video_url = $filename;
        }


        // Update File
        if ($request->hasFile('download_file')) {
            if ($game->download_file && file_exists(public_path('storage/games/files/'.$game->download_file))) {
                unlink(public_path('storage/games/files/'.$game->download_file));
            }
            $file = $request->file('download_file');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('storage/games/files'), $filename);
            $game->download_file = $filename;
        }

        $game->save();

        return redirect()->back()->with('success', 'Game updated successfully!');
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
