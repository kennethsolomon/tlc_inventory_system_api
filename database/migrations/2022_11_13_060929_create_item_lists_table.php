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
        Schema::create('item_lists', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('description')->unique();
            $table->integer('cost');
            $table->integer('quantity');
            $table->enum('type', ['Consumable', 'Non-Consumable']);
            $table->enum('purchaser', ['Provincial Office', 'Regional Office']);
            $table->foreignId('item_category_id')->constrained();
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
        Schema::dropIfExists('item_lists');
    }
};
