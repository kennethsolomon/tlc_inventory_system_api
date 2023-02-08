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
        Schema::create('consumable_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('consumable_id')->nullable()->constrained('consumables');
            $table->foreignId('received_by_id')->nullable()->constrained('employees');
            $table->string('agency');
            $table->date('check_out_date');
            $table->integer('quantity');
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
        Schema::dropIfExists('consumable_histories');
    }
};
