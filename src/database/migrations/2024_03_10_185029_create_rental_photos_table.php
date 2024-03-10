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
            $table->string('name');
            $table->integer('size');
            $table->string('mime');
            $table->string('path');
            $table->integer('order');
            $table->integer('rental_id');
            $table->integer('user_id');
            $table->timestamps();
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
