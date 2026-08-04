<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->json('title');          // tr, en, ar
            $table->json('description');    // tr, en, ar
            $table->json('category');       // tr, en, ar
            $table->string('youtube_id');   // sadece video ID, embed URL'i accessor'da üretiriz
            $table->string('duration')->nullable(); // "4:12" gibi
            $table->string('thumbnail')->nullable(); // storage path, boşsa YT thumbnail fallback
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
