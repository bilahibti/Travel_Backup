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
        Schema::create('hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destination')->onDelete('cascade');
            $table->string('hotel_name');
            $table->text('address');
            $table->text('description');
            $table->integer('star_rating');
            $table->decimal('price_per_night', 12, 2);
            $table->text('facilities');
            $table->integer('quota')->default(1); 
            $table->integer('booked')->default(0);
            $table->string('foto')->nullable();
            $table->enum('status', ['Available', 'Full Booked'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel');
    }
};
