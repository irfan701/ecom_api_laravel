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
        Schema::create('site_info', function (Blueprint $table) {
            $table->id();
            $table->text('about',5000);
            $table->text('terms',5000);
            $table->text('policy',5000);
            $table->text('purchase_guide',5000);
            $table->text('about_company',5000);
            $table->text('address',5000);
            $table->string('android_app_link',100);
            $table->string('ios_app_link',100);
            $table->string('facebook_link',100);
            $table->string('twitter_link',100);
            $table->string('instagram_link',100);
            $table->text('delivery_notice',100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_info');
    }
};
