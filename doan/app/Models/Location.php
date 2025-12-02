<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'itinerary_id',
        'name',
        'description',
        'image',
        'is_delete'
    ];

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}
