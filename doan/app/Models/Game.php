<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'duration',
        'instructions',
        'video_url',
        'download_file',
        'status',
        'is_delete',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_game', 'game_id', 'category_id');
    }
    public function materials()
    {
        return $this->belongsToMany(Material::class, 'game_material', 'game_id', 'material_id');
    }
}
