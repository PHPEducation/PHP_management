<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MiddlewareTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMiddleware()
    {
        $data = [
            'name' => 'test'
        ];
        $reponse = $this->json('POST', route('teams.store'), $data);
        $reponse->assertStatus(401);
        $reponse->assertJson(['message' => "Unauthenticated."]);
    }
}
