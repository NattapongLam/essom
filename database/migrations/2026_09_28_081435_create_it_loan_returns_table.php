<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItLoanReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('it_loan_returns', function (Blueprint $table) {
            $table->id('it_loan_returns_id');
            $table->string('quantity')->nullable();
            $table->string('equipment_name')->nullable();
            $table->string('borrower')->nullable();
            $table->string('details')->nullable();
            $table->date('borrow_date')->nullable();
            $table->string('borrow_by')->nullable();
            $table->date('return_date')->nullable();
            $table->string('return_by')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('it_loan_returns');
    }
}
