<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Itinerary;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Lấy tất cả category + tối đa 3 game
        $categories = Category::with(['games' => function ($q) {
            $q->where('status', 1)
              ->orderBy('id', 'asc')
              ->limit(3);
        }])->get();


        foreach ($categories as $cat) {
            $cat->limited_games = $cat->games;
        }

        // Lấy itineraries + 1 location để lấy ảnh
        $itineraries = Itinerary::where('status', 1)
            ->where('is_delete', 0)
            ->with(['locations' => function ($q) {
                $q->where('is_delete', 0)->limit(1);
            }])
            ->limit(6)
            ->get();

        return view('user.dashboard', compact('categories', 'itineraries'));
    }
}
