<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'is_delete',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'category_game', 'category_id', 'game_id');
    }

}
