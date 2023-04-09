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
            $table->string('property_code')->nullable();
            $table->string('category')->nullable();
            $table->string('purchase_date')->nullable();
            // $table->string('warranty_period');
            $table->string('assigned_to')->nullable();
            $table->string('location')->nullable();
            $table->string('custodian')->nullable();
            $table->string('has_been_disposed')->nullable();
            $table->string('has_been_fixed')->default(false)->nullable();
            $table->boolean('is_approved')->default(false);

            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('frequency')->nullable();
            $table->string('description')->nullable();
            $table->string('notes')->nullable();
            $table->string('part')->nullable();
            $table->string('schedule_date')->nullable();
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
