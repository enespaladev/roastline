<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->json('name');   // Spatie HasTranslations: ['tr' => 'Uzman Kavurma', 'en' => 'Expert Roasting', 'ar' => '...']
            $table->json('slug');   // Spatie HasTranslations: ['tr' => 'uzman-kavurma', 'en' => 'expert-roasting', 'ar' => '...']
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
