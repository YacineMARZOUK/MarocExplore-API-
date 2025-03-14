<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;
    protected $fillable = [
        'itinerary_id',
        'name',
        'lodging',
        'places_to_visit',
        'activities',
        'food_to_try',
    ];
    //Convertit les champs JSON en tableaux PHP automatiquement
    protected $casts = [
        'places_to_visit' => 'array',
        'activities' => 'array',
        'food_to_try' => 'array',
    ];
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
    public function aVisiter()
    {
        return $this->hasMany(AVisiter::class);
    }
}
