<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Previlege;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
