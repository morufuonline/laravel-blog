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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(0)->constrained('users', 'id')->onDelete('cascade');
            $table->string("title");
            $table->longText("body");
            $table->timestamps();
            $table->fullText(['title', 'body']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function($table) {
            $table->dropFullText(['title', 'body']);
        });
        Schema::dropIfExists('posts');
    }
};
