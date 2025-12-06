<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    protected $table = 'itineraries';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
        'days',
        'status',
        'is_delete',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class, 'itinerary_id', 'id');
    }
}
