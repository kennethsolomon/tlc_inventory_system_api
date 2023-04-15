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
        Schema::create('lend_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->nullable()->constrained('properties');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('property_code');
            $table->string('category');
            $table->integer('unit_cost');
            $table->string('description');
            $table->string('date_of_lending');
            $table->string('return_date');
            $table->string('borrower_name');
            $table->string('location');
            $table->string('reason_for_lending');
            $table->string('is_lend')->nullable();
            $table->string('returned_date')->nullable();
            $table->boolean('is_overdue')->default(false);
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
        Schema::dropIfExists('lend_properties');
    }
};
