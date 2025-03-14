<?php

use App\Http\Controllers\ItineraryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AVisiterController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//avisiterr rouute
Route::middleware('auth:sanctum')->group(function () {
    Route::get('a-visiter', [AVisiterController::class, 'index']);
    Route::get('a-visiter/{id}', [AVisiterController::class, 'show']);
    Route::post('a-visiter', [AVisiterController::class, 'store']);
    Route::put('a-visiter/{id}', [AVisiterController::class, 'update']);
    Route::delete('a-visiter/{id}', [AVisiterController::class, 'destroy']);
});



// Gestion des destinations (authentification requise)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/itineraries/{itinerary_id}/destinations', [DestinationController::class, 'store']);
    Route::put('/destinations/{id}', [DestinationController::class, 'update']);
    Route::delete('/destinations/{id}', [DestinationController::class, 'destroy']);
});
Route::post('/itinerary/{id}/destination/add', [DestinationController::class, 'store'])->middleware('auth:sanctum');
Route::get('/itinerary/{id}/destinations', [DestinationController::class, 'show']);


// Accès public pour voir une destination
Route::get('/destinations/{id}', [DestinationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/itineraries/{id}', [ItineraryController::class, 'update']);
    Route::delete('/itineraries/{id}', [ItineraryController::class, 'destroy']);
});
Route::get('/itineraries/search', [ItineraryController::class, 'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// register 

Route::post('/register', [AuthController::class , 'store'])->name('create.user');

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::post('/itinerary/add', [ItineraryController::class , 'store'])->name('create.itinerary');
});

Route::get('/itinerary/show' ,[ItineraryController::class , 'show']);