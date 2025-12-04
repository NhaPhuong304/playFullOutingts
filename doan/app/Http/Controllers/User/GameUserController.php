<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Category;
use Illuminate\Http\Request;

class GameUserController extends Controller
{
    // 🟩 Trang Game chính: mỗi category hiện 3 game
    public function game()
    {
        $categories = Category::where('is_delete', 0)->get();

        $data = [];

        foreach ($categories as $cat) {
            $data[] = [
                'category' => $cat,
                'games'    => Game::whereHas('categories', function ($q) use ($cat) {
                                    $q->where('id', $cat->id);
                                })
                                ->where('is_delete', 0)
                                ->take(3)
                                ->get()
            ];
        }

        return view('user.game', compact('data'));
    }

    // 🟦 Trang riêng theo Category ID
    public function category($id)
    {
        $category = Category::findOrFail($id);

        $games = Game::whereHas('categories', function ($q) use ($id) {
                        $q->where('id', $id);
                    })
                    ->where('is_delete', 0)
                    ->get();

        return view('user.categoryPage', compact('category', 'games'));
    }

    public function detailGame($id)
    {
        $game = Game::with(['materials', 'categories'])
                    ->where('id', $id)
                    ->where('is_delete', 0)
                    ->firstOrFail();

        return view('user.detailGame', compact('game'));
    }
}
