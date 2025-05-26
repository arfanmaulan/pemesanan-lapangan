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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lapangan_id')->constrained()->onDelete('cascade');
            $table->foreignId('slot_waktu_id')->constrained()->onDelete('cascade');
            $table->foreignId('metode_pembayaran_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_booking');
            $table->string('status_pembayaran'); // unpaid, paid
            $table->string('status'); // pending, confirmed, cancelled
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
