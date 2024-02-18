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
        Schema::create('category_level_two', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_one_id')->constrained('category_level_one')->cascadeOnDelete();
            $table->string('cat_two_name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_level_two');
    }
};
