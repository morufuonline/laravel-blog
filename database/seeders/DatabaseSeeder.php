<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Post;
use Database\Seeders\PrivilegeSeeder;
use Database\Seeders\RoleManagementSeeder;

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
        $this->call([
            PrivilegeSeeder::class,
            RoleManagementSeeder::class,
        ]);
       
    }
}
