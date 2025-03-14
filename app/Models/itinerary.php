<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itinerary extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'category',
        'duration',
        'image',
        'description',
    ];
    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
