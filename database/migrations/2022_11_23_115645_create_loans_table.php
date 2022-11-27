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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no');
            $table->string('lender_name');
            $table->string('lender_agency');
            $table->string('lender_designation');
            $table->string('borrower_name');
            $table->string('borrower_agency');
            $table->string('borrower_designation');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('purpose_of_loan');
            $table->enum('condition', ['New', 'Used', 'Damaged']);
            $table->json('item_data')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('loans');
    }
};
