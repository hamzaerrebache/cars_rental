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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('First_name_client')->nullable();
            $table->string('Last_name_client')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_client',80)->unique();
            $table->string('password_client')->nullable();
            $table->string('adress_client')->nullable();
            $table->integer('Code_postal_client')->nullable();
            $table->string('city_client')->nullable();
            $table->string('country_client')->nullable();
            $table->string('pays_client')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
