<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->json('badge')->nullable()->after('image');          // translatable: "Yeni" / "New" / "جديد"
            $table->json('capacity')->nullable()->after('badge');       // translatable: "1000 kg/saat"
            $table->unsignedInteger('capacity_value')->nullable()->after('capacity'); // admin panelden manuel: 1000
            $table->json('power')->nullable()->after('capacity_value'); // translatable: "15 kW"
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['badge', 'capacity', 'capacity_value', 'power']);
        });
    }
};
