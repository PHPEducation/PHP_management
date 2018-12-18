<?php

namespace Tests\Unit\Http;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TraineeTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    public function test_index_trainee()
    {
        $res = $this->json('GET', route('trainees.index'));
        dd($res);
        $res->assertStatus(200);
    }
}
