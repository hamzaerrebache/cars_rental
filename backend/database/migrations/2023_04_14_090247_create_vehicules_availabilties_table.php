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
        Schema::create('vehicle_availabilties', function (Blueprint $table) {
            $table->id();
            $table->date('avaible_date');
            $table->unsignedBigInteger('vehicule_id')->nullable(false);
            $table->unsignedBigInteger('location_id')->nullable(false);
            $table->foreign('location_id')->references('id')->on('vehicules_locations')->onDelete('cascade');
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_availabilties');
    }
};
