<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_authenticated_user_can_create_post()
    {
        $user = User::factory()->create();
        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/posts', [
            'title' => 'Test Post Title',
            'content' => 'Content of the post',
            'status' => 'published',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Post Title']);
    }

    public function test_guest_cannot_create_post()
    {
        $response = $this->postJson('/api/posts', [
            'title' => 'Test Post Title',
            'content' => 'Content of the post',
            'status' => 'published',
        ]);

        $response->assertStatus(401);
    }
}
