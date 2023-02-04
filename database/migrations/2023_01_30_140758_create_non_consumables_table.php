<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_consumables', function (Blueprint $table) {
            $table->id();
            $table->string('property_code');
            $table->string('property_name');
            $table->string('description');
            $table->string('serial_number');
            $table->integer('cost');
            $table->string('location');
            $table->date('date_of_purchased');
            $table->date('warranty_expiration');
            $table->date('end_of_life');
            $table->enum('status', ['available', 'unavailable'])->default('available');

            $table->foreignid('assigned_to')->nullable()->constrained('employees');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('non_consumables');
    }
};
