<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\itinerary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $itinerary_id)
    {
        //
        $itinerary = itinerary::findOrFail($itinerary_id);
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['message','acces refuserr'],'403');
        }
        $request->validate([
            'name' =>'required|string|max:255',
            'lodging' => 'nullable|string|max:255',
            'places_to_visit' => 'nullable|array',
            'activities' => 'nullable|array',
            'food_to_try' => 'nullable|array',
        ]);
        $destination = $itinerary->destinations()->create([
            'name' => $request->name,
            'lodging' => $request->lodging,
            'places_to_visit' => $request->places_to_visit,
            'activities' => $request->activities,
            'food_to_try' => $request->food_to_try,
        ]);
        return response()->json(['message' => 'Destination ajoutée avec succès', 'destination' => $destination], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($itineraryId)
    {
        $destinations = Itinerary::findOrFail($itineraryId)->destinations;
        return response()->json($destinations);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $disrination = Destination::findOrFail($id);
        return response()->json($disrination);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $itinerary = $destination->itinerary;

        if($itinerary->user_id !== Auth::id()){
            return response()->json(['message','accee refuser dyel id dyel luser ly bgha editer'],'403');
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'lodging' => 'sometimes|string|max:255',
            'places_to_visit' => 'sometimes|array',
            'activities' => 'sometimes|array',
            'food_to_try' => 'sometimes|array',
        ]);
        $destination->update($request->all());
        return response()->json(['message' => 'Destination mise à jour avec succès', 'destination' => $destination]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $itinerary = $destination->itinerary;
        if ($itinerary->user_id !== Auth::id()) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }
        $destination->delete();

        return response()->json(['message' => 'Destination supprimée avec succès']);
    }
}
