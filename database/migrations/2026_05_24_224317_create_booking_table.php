<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Tabel utama booking ──────────────────────────────────────────
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user')->cascadeOnDelete();
            $table->string('booking_code', 20)->unique();
            $table->enum('type', ['package', 'hotel', 'transport']);
            $table->enum('status', [
                'pending', 'confirmed', 'in_progress', 'completed', 'cancelled', 'refunded'
            ])->default('pending');
            $table->decimal('subtotal',    15, 2)->default(0);
            $table->decimal('discount',    15, 2)->default(0);
            $table->decimal('tax',         15, 2)->default(0);
            $table->decimal('total_price', 15, 2)->default(0);
            $table->date('travel_date');
            $table->date('return_date')->nullable();
            $table->unsignedSmallInteger('total_persons')->default(1);
            $table->string('contact_name',  100);
            $table->string('contact_phone',  20);
            $table->string('contact_email');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('booking_code');
        });

        // ── Booking Paket Wisata ─────────────────────────────────────────
        Schema::create('booking_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained('booking')->cascadeOnDelete();
            $table->foreignId('travel_package_id')
                  ->constrained('travel_packages')->restrictOnDelete();
            $table->unsignedSmallInteger('persons')->default(1);
            $table->decimal('unit_price',           15, 2);
            $table->decimal('packages_total_price', 15, 2);
            $table->timestamps();
        });

        // ── Booking Hotel ────────────────────────────────────────────────
        Schema::create('booking_hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained('booking')->cascadeOnDelete();
            $table->foreignId('hotel_id')
                  ->constrained('hotel')->restrictOnDelete();
            $table->foreignId('hotel_room_id')
                  ->constrained('hotel_rooms')->restrictOnDelete();
            $table->date('check_in');
            $table->date('check_out');
            $table->unsignedSmallInteger('rooms')->default(1);
            $table->unsignedSmallInteger('nights')->default(1);
            $table->decimal('price_per_night', 15, 2);
            $table->decimal('total_price',     15, 2);
            $table->timestamps();
        });

        // ── Booking Transportasi ─────────────────────────────────────────
        Schema::create('booking_transport', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained('booking')->cascadeOnDelete();
            $table->foreignId('transportation_id')
                  ->constrained('transportation')->restrictOnDelete();
            $table->unsignedSmallInteger('days')->default(1);
            $table->decimal('price_per_day', 15, 2);
            $table->decimal('total_price',   15, 2);
            $table->string('pickup_location',  255);
            $table->string('dropoff_location', 255)->nullable();
            $table->text('special_request')->nullable();
            $table->timestamps();
        });

        // ── Payment ──────────────────────────────────────────────────────
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')
                  ->constrained('booking')->cascadeOnDelete();
            $table->string('payment_code', 20)->unique();
            $table->decimal('amount', 15, 2);
            $table->enum('method', [
                'bank_transfer', 'credit_card', 'debit_card',
                'e_wallet', 'virtual_account', 'qris'
            ]);
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])
                  ->default('pending');
            $table->string('transaction_id')->nullable();
            $table->json('payment_detail')->nullable();   // metadata tambahan
            $table->text('notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index(['booking_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
        Schema::dropIfExists('booking_transport');
        Schema::dropIfExists('booking_hotel');
        Schema::dropIfExists('booking_packages');
        Schema::dropIfExists('booking');
    }
};