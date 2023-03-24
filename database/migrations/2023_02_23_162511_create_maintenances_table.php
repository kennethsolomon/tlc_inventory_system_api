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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained('properties');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('property_code');
            $table->string('category');
            $table->string('purchase_date');
            // $table->string('warranty_period');
            $table->string('assigned_to');
            $table->string('location');
            $table->string('notes');
            $table->string('custodian')->nullable();
            $table->string('has_been_disposed');
            $table->string('has_been_fixed');
            $table->boolean('is_approved')->default(false);
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
        Schema::dropIfExists('maintenances');
    }
};
