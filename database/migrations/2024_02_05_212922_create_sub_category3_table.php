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
        Schema::create('sub_category3', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_cat_id')->constrained('sub_categories')->cascadeOnDelete();
            $table->string('cat3_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_category3');
    }
};
