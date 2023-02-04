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
        Schema::create('non_consumable_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('non_consumable_id')->constrained('non_comsumables');
            $table->foreignId('employee_id')->constrained('employees');
            $table->date('date_of_lending');
            $table->date('due_by_date');
            $table->enum('condition_of_property', ['New', 'Used', 'Damage/Unusable'])->default('New');
            $table->string('reason_for_lending');
            $table->date('returned_date')->nullable();
            $table->string('returned_notes')->nullable();
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
        Schema::dropIfExists('non_consumable_histories');
    }
};
