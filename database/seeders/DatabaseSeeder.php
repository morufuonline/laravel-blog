<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use App\Models\Previlege;
use App\Models\RoleManagement;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Post::factory(10)->create();
        Previlege::create([
            'previlege_col' => 'browse_post',
            'previlege' => 'Browse Post',
        ]);
        Previlege::create([
            'previlege_col' => 'read_post',
            'previlege' => 'Read Post',
        ]);
        Previlege::create([
            'previlege_col' => 'create_post',
            'previlege' => 'Create Post',
        ]);
        Previlege::create([
            'previlege_col' => 'edit_post',
            'previlege' => 'Edit Post',
        ]);
        Previlege::create([
            'previlege_col' => 'delete_post',
            'previlege' => 'Delete Post',
        ]);
        RoleManagement::create([
            'role' => 'Manager',
            'browse_posts' => true,
            'read_posts' => true,
            'create_posts' => true,
            'edit_posts' => true,
            'delete_posts' => true,
            'posted_by' => 1,
        ]);
    }
}
