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
        Schema::create('transportation', function (Blueprint $table) {
            $table->id();
            $table->string('transportation_name');
            $table->string('transportation_type');
            $table->string('departure');
            $table->string('arrival');
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->decimal('price_per_person', 12, 2);
            $table->integer('quota')->default(1);
            $table->integer('booked')->default(0);
            $table->enum('status', ['Available', 'Full Booked'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportation');
    }
};
