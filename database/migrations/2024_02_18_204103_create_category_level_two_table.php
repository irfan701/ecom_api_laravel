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
            $table->foreignId('cat1_id')->constrained('category_level_one')->cascadeOnDelete();
            $table->string('cat2_name');
            $table->string('cat2_slug');

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
