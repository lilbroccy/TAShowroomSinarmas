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
        Schema::create('car_units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('year');
            $table->enum('fuel_type', ['Diesel', 'Bensin', 'Listrik']);
            $table->enum('transmission', ['Manual', 'Automatic', 'CVT', 'DCT', 'AMT']);
            $table->integer('seat');
            $table->string('warranty');
            $table->string('color');
            $table->integer('mileage');
            $table->integer('engine_cc');
            $table->boolean('service_book');
            $table->boolean('spare_key');
            $table->boolean('unit_document');
            $table->string('stnk_validity_period');
            $table->text('description')->nullable();
            $table->enum('status', ['Tersedia', 'Terjual', 'Menunggu Verifikasi', 'Ditolak'])->default('Tersedia');
            $table->enum('type', ['Titipan', 'Bukan Titipan'])->default('Bukan Titipan');
            $table->enum('type_status', ['Menunggu Verifikasi', 'Disetujui', 'Ditolak', 'Tersedia'])->default('Tersedia');
            $table->integer('fee')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_units');
    }
};
