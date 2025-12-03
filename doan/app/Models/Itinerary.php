<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'days',
        'status',
        'is_delete',
    ];
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'location_itinerary');
    }

}
