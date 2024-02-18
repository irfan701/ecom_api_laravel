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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cat_one_id')->constrained('category_level_one')->cascadeOnDelete();
            $table->foreignId('cat_two_id')->constrained('category_level_two')->cascadeOnDelete();
            $table->foreignId('cat_three_id')->constrained('category_level_three')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            $table->string('title');
            $table->string('product_code');
            $table->string('sku')->nullable();
            $table->string('price');
            $table->string('special_price')->nullable();
            $table->string('remark')->nullable();
            $table->string('star')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
