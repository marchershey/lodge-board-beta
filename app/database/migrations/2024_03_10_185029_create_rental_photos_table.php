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
        Schema::create('rental_photos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('path');
            $table->string('hashName');
            $table->string('extension');
            $table->string('origName');
            $table->string('origExtension');
            $table->string('size');
            $table->string('mime');
            $table->integer('rental_id');
            $table->integer('user_id');
            $table->integer('order');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_photos');
    }
};
