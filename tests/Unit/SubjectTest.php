<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Subject;

class SubjectTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    public function test_can_create_subject()
    {
        $data = [
            'name' => 'Abc',
            'day' => 1
        ];

        $response = $this->json('POST', route('subjects.store'), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_can_update_subject()
    {
        $subject = factory(Subject::class)->create();

        $data = [
            'name' => 'test update',
            'day' => 2
        ];

        $response = $this->json('PUT', route('subjects.update', $subject->id), $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_can_delete_subject()
    {
        $subject = factory(Subject::class)->create();
        $response = $this->json('DELETE', route('subjects.destroy', $subject->id));
        $response->assertStatus(200);
    }
}
