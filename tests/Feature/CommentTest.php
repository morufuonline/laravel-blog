<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{

    public function test_create_comment_successfully_via_api(){

        $comment = [
            "body" => "This is fantastic. I really appreciate."
        ];
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer 1|rVbAAPaUHtxm3A37fsSHmLpxs9sXqCbxmURBNwOn304d4433',
        ])->postJson("/api/posts/comment/2", $comment);
        $response->assertStatus(201);
        $this->assertDatabaseHas("comments", $comment);
    }

}
