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
        Schema::create('properties', function (Blueprint $table) {
            $table->id()->from(1000);
            $table->string('name')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_state')->nullable();
            $table->integer('address_zip')->nullable();
            $table->string('property_headline')->nullable();
            $table->text('property_description')->nullable();
            $table->integer('guest_count')->nullable();
            $table->integer('bed_count')->nullable();
            $table->integer('bedroom_count')->nullable();
            $table->decimal('bathroom_count', 4, 1)->nullable();
            $table->string('rate')->nullable();
            $table->string('tax_rate')->nullable();
            $table->string('calendar_color')->nullable();
            $table->integer('min_nights')->nullable();
            $table->boolean('active')->default(true)->nullable();
            $table->integer('host_id')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('in_progress')->default(true);
            // $table->integer('type_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
