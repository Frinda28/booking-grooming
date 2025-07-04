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
            $table->string('nama_hewan');
            $table->string('jenis_hewan');
            $table->string('usia');
            $table->string('pemilik');
            $table->char('nomor_telepon');
            $table->date('tanggal_booking');
            $table->time('jam_booking'); 
            $table->string('images')->nullable();   
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
