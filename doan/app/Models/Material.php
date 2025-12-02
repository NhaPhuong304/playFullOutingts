<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    // Quan hệ với Games
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_material', 'material_id', 'game_id');
    }
}
