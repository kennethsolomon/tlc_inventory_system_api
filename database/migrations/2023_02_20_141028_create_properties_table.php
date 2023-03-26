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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_code');
            $table->string('serial_number');
            $table->string('purchase_date');
            // $table->string('warranty_period');
            $table->string('brand');
            $table->string('model');
            $table->string('category');
            $table->string('description');

            $table->string('maintenance')->nullable();
            $table->string('maintenance_description')->nullable();

            $table->boolean('pending_lend')->default(false)->nullable();
            $table->boolean('init_transfer')->default(false)->nullable();


            $table->string('assigned_to')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['Unavailable', 'On Stock',  'In Custody', 'Disposed', 'In Repair', ''])->default('On Stock')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
