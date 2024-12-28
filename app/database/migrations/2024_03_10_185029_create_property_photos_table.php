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
        Schema::create('property_photos', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('path');
            $table->string('disk_path');
            $table->string('name');
            $table->string('extension');
            $table->string('size');
            $table->string('mime');
            $table->string('orig_name');
            $table->string('orig_extension');
            $table->json('dimensions');
            $table->integer('property_id');
            $table->integer('user_id');
            $table->integer('position');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_photos');
    }
};
