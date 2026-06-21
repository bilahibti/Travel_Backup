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
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destination_id'); 
            $table->unsignedBigInteger('hotel_id'); 
            $table->unsignedBigInteger('transportation_id'); 
            $table->string('packages_name');
            $table->text('description');
            $table->decimal('price_packages', 12, 2);
            $table->enum('package_type', ['Domestic', 'International'])->default('Domestic');
            $table->string('include');
            $table->string('exclude');
            $table->integer('quota')->default(1); 
            $table->integer('booked')->default(0);
            $table->enum('status', ['Available', 'Full Booked'])->default('Available');
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->integer('duration_days')->default(1);
            $table->integer('max_persons')->default(10);
            $table->boolean('is_active')->default(true);
            $table->foreign('destination_id')->references('id')->on('destination'); 
            $table->foreign('hotel_id')->references('id')->on('hotel'); 
            $table->foreign('transportation_id')->references('id')->on('transportation'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_packages');
    }
};
