<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('lodging')->nullable(); // Lieu de logement
            $table->json('places_to_visit')->nullable(); // Liste d'endroits à visiter
            $table->json('activities')->nullable(); // Liste d'activités
            $table->json('food_to_try')->nullable(); // Plats à essayer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
    }

    /**
     * Reverse the migrations.
     */
    
;
