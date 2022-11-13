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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('property_code');
            $table->string('description');
            $table->string('serial_number');
            $table->integer('quantity');
            $table->integer('cost');
            $table->date('date_acquired');
            $table->date('date_received');
            $table->enum('type', ['Consumable', 'Non-Consumable']);
            $table->enum('purchaser', ['Provincial Office', 'Regional Office']);
            $table->foreignId('location_id')->constrained();
            $table->foreignId('item_category_id')->constrained();
            $table->foreignId('received_by_id')->constrained('employees');
            $table->foreignId('received_from_id')->constrained('employees');
            $table->foreignId('assigned_person_id')->constrained('employees');
            $table->foreignId('item_status_id')->nullable()->constrained();
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
        Schema::dropIfExists('items');
    }
};
