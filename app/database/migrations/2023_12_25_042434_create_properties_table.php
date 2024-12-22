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
            // Basics
            $table->string('name');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('address_city');
            $table->string('address_state');
            $table->integer('address_postal');
            $table->string('address_country');
            // Listing
            $table->string('listing_headline');
            $table->text('listing_description');
            $table->integer('type_id');
            $table->integer('guest_count');
            $table->integer('bed_count');
            $table->integer('bedroom_count');
            $table->decimal('bathroom_count', 4, 1);
            // Pricing
            $table->integer('base_rate');
            $table->integer('tax_rate');
            // Options
            $table->string('slug');
            $table->string('calendar_color');
            $table->integer('duration_min');
            $table->integer('duration_max');
            $table->string('visibility');

            $table->integer('host_id');
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
