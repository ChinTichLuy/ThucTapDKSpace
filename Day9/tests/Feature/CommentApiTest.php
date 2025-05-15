<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CommentApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_authenticated_user_can_comment_on_post()
    {
         $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Tạo post thủ công
        $post = Post::create([
            'title' => 'Test Post',
            'slug' => 'test-post',
            'content' => 'Content of the test post',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        // Tạo token cho user
        $token = $user->createToken('api-token')->plainTextToken;

        // Gửi request có token để comment
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->postJson("/api/posts/{$post->id}/comments", [
            'content' => 'Test comment content',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['content' => 'Test comment content']);
    }

    public function test_guest_cannot_comment_on_post()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser2@example.com',
            'password' => Hash::make('password123'),
        ]);

        $post = Post::create([
            'title' => 'Test Post 2',
            'slug' => 'test-post', 
            'content' => 'Content of the second test post',
            'status' => 'published',
            'user_id' => $user->id,
        ]);

        // Không gửi token => guest
        $response = $this->postJson("/api/posts/{$post->id}/comments", [
            'content' => 'Test comment content',
        ]);

        $response->assertStatus(401);
    }
}
