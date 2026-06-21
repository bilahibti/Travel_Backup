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
        Schema::create('destination', function (Blueprint $table) {
            $table->id();
            $table->string('destination_name');
            $table->string('country');
            $table->string('city');
            $table->text('description');
            $table->enum('destination_type', ['Domestic', 'International']);
            $table->integer('quota')->default(1); 
            $table->integer('booked')->default(0);
            $table->enum('status', ['Available', 'Full Booked'])->default('Available');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination');
    }
};
