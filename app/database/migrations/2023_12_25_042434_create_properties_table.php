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
            $table->string('name');
            $table->string('address_street');
            $table->string('address_city');
            $table->string('address_state');
            $table->integer('address_zip');
            $table->string('property_headline');
            $table->text('property_description');
            $table->integer('guest_count');
            $table->integer('bed_count');
            $table->integer('bedroom_count');
            $table->decimal('bathroom_count', 4, 1);
            $table->string('rate');
            $table->string('tax_rate');
            $table->string('calendar_color');
            $table->integer('min_nights');
            $table->boolean('active')->default(true);
            $table->integer('host_id');
            $table->string('slug');
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
