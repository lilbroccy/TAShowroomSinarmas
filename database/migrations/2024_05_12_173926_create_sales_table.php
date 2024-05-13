<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('check_unit_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('car_unit_id');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('payment_method');
            $table->date('date')->nullable();
            $table->unsignedBigInteger('last_edit_by')->nullable();
            $table->timestamps();

            $table->foreign('check_unit_id')->references('id')->on('check_units')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('car_unit_id')->references('id')->on('car_units')->onDelete('cascade');
            $table->foreign('last_edit_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

