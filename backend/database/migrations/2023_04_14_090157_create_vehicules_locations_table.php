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
        Schema::create('vehicules_locations', function (Blueprint $table) {
            $table->id();
            $table->string('location_name')->nullable(false);
            $table->string('location_address')->nullable(false);
            $table->unsignedBigInteger('city_id')->nullable(false);
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules_locations');
    }
};
