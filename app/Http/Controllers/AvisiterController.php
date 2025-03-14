<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AVisiter;
use App\Models\Destination;

class AvisiterController extends Controller
{
    public function index()
    {
        $lieuxAVister = AVisiter::all();
        return response()->json($lieuxAVister);
    }

    // Afficher un lieu spécifique
    public function show($id)
    {
        $lieuAVister = AVisiter::find($id);
        if (!$lieuAVister) {
            return response()->json(['message' => 'Lieu à visiter non trouvé'], 404);
        }
        return response()->json($lieuAVister);
    }

    // Créer un nouveau lieu à visiter
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string',
            'destination_id' => 'required|exists:destinations,id',
            'utilisateur_id' => 'required|exists:users,id',
        ]);

        $lieuAVister = AVisiter::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'destination_id' => $request->destination_id,
            'utilisateur_id' => $request->utilisateur_id,
        ]);

        return response()->json($lieuAVister, 201);
    }

    // Mettre à jour un lieu à visiter
    public function update(Request $request, $id)
    {
        $lieuAVister = AVisiter::find($id);
        if (!$lieuAVister) {
            return response()->json(['message' => 'Lieu à visiter non trouvé'], 404);
        }

        $request->validate([
            'nom' => 'string|max:255',
            'description' => 'string',
            'destination_id' => 'exists:destinations,id',
            'utilisateur_id' => 'exists:users,id',
        ]);

        $lieuAVister->update($request->all());

        return response()->json($lieuAVister);
    }

    // Supprimer un lieu à visiter
    public function destroy($id)
    {
        $lieuAVister = AVisiter::find($id);
        if (!$lieuAVister) {
            return response()->json(['message' => 'Lieu à visiter non trouvé'], 404);
        }

        $lieuAVister->delete();

        return response()->json(['message' => 'Lieu à visiter supprimé avec succès']);
    }
}
