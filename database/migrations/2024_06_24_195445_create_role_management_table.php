<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_management', function (Blueprint $table) {
            $table->id();
            $table->string("role");
            $table->boolean("browse_posts")->default(false);
            $table->boolean("read_posts")->default(false);
            $table->boolean("create_posts")->default(false);
            $table->boolean("edit_posts")->default(false);
            $table->boolean("delete_posts")->default(false);
            $table->foreignId('posted_by')->nullable()->default(0)->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_management');
    }
};
