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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_no');
            $table->enum('condition', ['New', 'Used', 'Damaged']);
            $table->string('transfer_type');
            $table->string('transfer_type_others')->nullable();
            $table->string('reason_for_transfer');
            $table->string('received_by');
            $table->string('borrower_designation');
            $table->string('borrower_agency');
            $table->string('received_from');
            $table->string('lender_designation');
            $table->string('lender_agency');
            $table->string('approved_by');
            $table->string('approver_designation');
            $table->json('item_data')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
