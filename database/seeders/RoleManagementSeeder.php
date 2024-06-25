<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleManagement;

class RoleManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
