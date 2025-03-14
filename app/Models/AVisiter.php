<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AVisiter extends Model
{
    use HasFactory;
    protected $table = 'a_visiter';

    // Définit les colonnes pouvant être remplies en masse (mass assignment)
    protected $fillable = [
        'nom', 
        'description', 
        'destination_id', 
        'utilisateur_id'
    ];

    // Définit la relation avec la table 'destinations' (chaque lieu est lié à une destination)
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    // Définit la relation avec la table 'users' (chaque lieu est ajouté par un utilisateur)
    public function utilisateur()
    {
        return $this->belongsTo(User::class);
    }
}
