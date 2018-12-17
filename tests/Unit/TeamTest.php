<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Team;

class TeamTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    public function test_can_create_team()
    {
        $data = [
            'name' => 'Team21',
        ];

        $response = $this->json('POST', route('teams.store'), $data);
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Add successful!',
        ]);
    }

    public function test_can_update_team()
    {
        $team = factory(Team::class)->create();

        $data = [
            'name' => 'Edit Team 1',
        ];
        $response = $this->json('PUT', route('teams.update', $team->id), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'name',
            'created_at',
            'updated_at',
        ]);
        $response->assertSuccessful();
    }

    public function test_can_delete_team()
    {
        $team = factory(Team::class)->create();

        $response = $this->json('DELETE',  route('teams.destroy', $team->id));
        $response->assertStatus(200);
    }
}
