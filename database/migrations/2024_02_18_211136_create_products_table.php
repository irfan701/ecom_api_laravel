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
            $table->foreignId('cat1_id')->constrained('category_level_one')->cascadeOnDelete();
            $table->foreignId('cat2_id')->constrained('category_level_two')->cascadeOnDelete();
            $table->foreignId('cat3_id')->nullable()->constrained('category_level_three')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();

            $table->string('title');
            $table->string('qty')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->string('price');
            $table->string('special_price')->nullable();

            $table->string('main_image')->nullable();

            $table->string('slug')->nullable();
            $table->string('tags')->nullable();
            $table->string('pcode')->default(0);
            $table->string('sku')->default(0);

            $table->string('star')->nullable();
            $table->string('remark')->nullable();

            $table->string('status')->default(1);
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
