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
        Schema::create('user', function (Blueprint $table) { 
            $table->id(); 
            $table->string('name'); 
            $table->string('email')->unique();  
            $table->string('password'); 
            $table->string('hp', 13); 
            $table->string('foto')->nullable(); 
            $table->timestamps(); 
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
