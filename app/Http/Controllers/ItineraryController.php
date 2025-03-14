<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Itinerary;

class ItineraryController extends Controller
{
    public function store(Request $request)
    {
        $id = Auth::id();
        $request->validate([
            "title" => "required|string|max:100",
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'category' => 'required|string',
        ]);

        $createItinerary = Itinerary::create([
            'user_id' => $id,
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'category' => $request->category,
        ]);

        if ($createItinerary) {
            return response()->json([
                'message' => "The itinerary has been created",
                'itinerary' => $createItinerary
            ], 200);
        } else {
            return response()->json([
                'message' => "There was an error"
            ], 500);
        }
    }

    public function show(Request $request)
    {
        return Itinerary::all();
    }

    public function update(Request $request, Itinerary $itinerary)
    {
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'duration' => 'sometimes|integer|min:1',
            'category' => 'sometimes|string',
        ]);

        $itinerary->update($request->all());

        return response()->json(['message' => 'Itinéraire mis à jour avec succès', 'itinerary' => $itinerary]);
    }

    public function destroy(Itinerary $itinerary)
    {
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $itinerary->delete();

        return response()->json(['message' => 'Itinéraire supprimé avec succès']);
    }

    public function search(Request $request)
    {
        $query = Itinerary::query();

        if ($request->has('keyword')) {
            $query->where('title', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('duration')) {
            $query->where('duration', '<=', $request->duration);
        }

        $itineraries = $query->paginate(10);

        return response()->json($itineraries);
    }
}