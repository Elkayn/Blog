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
        Schema::create('analitics', function (Blueprint $table) {
            $table->id();
            $table->integer('count_posts')->nullable();
            $table->integer('count_comments')->nullable();
            $table->integer('count_likes_posts')->nullable();
            $table->integer('count_likes_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analitics');
    }
};
