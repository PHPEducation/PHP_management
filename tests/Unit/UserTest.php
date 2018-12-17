<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserTest extends TestCase
{
	use RefreshDatabase;
	use WithoutMiddleware;

    public function test_update_role()
    {
    	$data = [
    		'role_id' => 1,
    	];

    	$user = factory(User::class)->create();

    	$response = $this->json('patch', route('update.role', $user->id), $data);
    	$response->assertStatus(200);
    }

    // public function test_update_avatar()
    // {
    // 	Storage::fake('public');

    //     $file = UploadedFile::fake()->image('avatar.jpg');
    // 	$response = $this->json('POST', route('update.avatar'), [
    //         'avatar' => $file,
    //     ]);

    //     Storage::disk('public')->assertExists($file->hashName());
    // }
}
