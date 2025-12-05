<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'is_delete',
    ];

    // Many-to-Many với Itinerary
    public function itineraries()
    {
        return $this->belongsToMany(
            Itinerary::class,
            'location_itinerary',
            'location_id',
            'itinerary_id'
        );
    }
    public function categoryLocations()
    {
        return $this->belongsToMany(
            CategoryLocation::class,
            'category_location_location',
            'location_id',
            'location_category_id'
        );
    }


}
