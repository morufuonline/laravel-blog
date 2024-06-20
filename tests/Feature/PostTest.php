<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_create_post_successfully_via_api(){

        $post = [
            "title" => "Competition between Man U fans and Chealsea fans",
            "body" => "This was a very long discussion which can take a very long time."
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1|rVbAAPaUHtxm3A37fsSHmLpxs9sXqCbxmURBNwOn304d4433',
        ])->postJson("/api/posts/create", $post);
        $response->assertStatus(201)->assertRedirect('/posts');;
        $this->assertDatabaseHas("posts", $post);
    }

    public function test_create_post_successfully_via_browser(){
    
        $user = User::factory()->create();
    
            $post = [
                "title" => "Competition between Man U fans and Chealsea fans",
                "body" => "This was a very long discussion which can take a very long time."
            ];
    
            $response = $this->actingAs($user)->post('/posts/store', $post);
            $response->assertStatus(201);
    
            $this->assertDatabaseHas('posts', $post);
    
        }    


}
