<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('a_visiter', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->string('nom'); // Nom du lieu
            $table->text('description')->nullable(); // Description du lieu
            $table->foreignId('destination_id')->constrained('destinations'); // Lien avec la table destinations
            $table->foreignId('utilisateur_id')->constrained('users'); // Lien avec la table users
            $table->timestamps(); // Pour les colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_visiter');
    }
};
