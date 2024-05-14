<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckUnitsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('check_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_unit_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('time');
            $table->enum('status', ['Disetujui', 'Ditolak', 'Menunggu Verifikasi', 'Selesai', 'Dibatalkan Oleh Sistem', 'Dibatalkan Oleh User']);
            $table->text('note')->nullable();
            $table->text('note_from_admin')->nullable();
            $table->string('payment')->nullable();
            $table->string('payment_proof')->nullable();
            $table->unsignedBigInteger('last_edit_by')->nullable();
            $table->timestamps();

            $table->foreign('car_unit_id')->references('id')->on('car_units')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('last_edit_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_units');
    }
};
