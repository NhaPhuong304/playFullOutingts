<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;

class GameController extends Controller
{
    public function game()
    {
        $categories = Category::where('status', 1)->where('is_delete', 0)->get();

        $gamesByCategory = [];

        foreach ($categories as $category) {
            $gamesByCategory[$category->name] = $category->games()
                ->where('status', 1)
                ->where('is_delete', 0)
                ->take(3)
                ->get();
        }

        return view('user.game', compact('categories', 'gamesByCategory'));
    }


    public function detailGame($slug)
    {
        $game = Game::where('slug', $slug)
            ->with('categories', 'materials') // eager load quan hệ nếu cần
            ->firstOrFail();

        // Lấy tất cả categories để menu hiển thị
        $categories = Category::where('is_delete', 0)->where('status', 1)->get();

        return view('user.detailGame', compact('game', 'categories'));
    }

    public function categoryGame($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Lấy toàn bộ game của category này
        $games = $category->games()
            ->where('status', 1)
            ->where('is_delete', 0)
            ->get();

        // Lấy categories để hiển thị menu
        $categories = Category::where('status', 1)->where('is_delete', 0)->get();

        return view('user.categoryGame', compact('category', 'games', 'categories'));
    }
    
}
