<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AVisterTest extends TestCase
{ 
    use RefreshDatabase;

    /**
     * Test l'ajout d'un lieu à visiter.
     *
     * @return void
     */
    public function test_user_can_add_a_visiter()
    {
        // Créer un utilisateur
        $user = User::factory()->create();

        // Obtenir un token de l'utilisateur
        $token = $user->createToken('apptoken')->plainTextToken;

        $response = $this->postJson('/api/a-visiter', [
            'nom' => 'Le Jardin Majorelle',
            'description' => 'Un jardin botanique célèbre situé à Marrakech.',
            'destination_id' => 1,  // Remplace cela par un ID valide dans ta base
            'utilisateur_id' => $user->id,
        ], [
            'Authorization' => 'Bearer ' . $token
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'nom' => 'Le Jardin Majorelle',
                     'description' => 'Un jardin botanique célèbre situé à Marrakech.',
                 ]);

        // Vérifier que le lieu a été ajouté à la base de données
        $this->assertDatabaseHas('a_visiter', [
            'nom' => 'Le Jardin Majorelle',
        ]);
    }
}
