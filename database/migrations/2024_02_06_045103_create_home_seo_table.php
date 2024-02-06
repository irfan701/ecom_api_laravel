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
        Schema::create('home_seo', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('des',1000);
            $table->string('keywords',1000);
            $table->string('og_title');
            $table->string('og_des',1000);
            $table->string('og_sitename');
            $table->string('og_url');
            $table->string('og_img');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_seo');
    }
};
