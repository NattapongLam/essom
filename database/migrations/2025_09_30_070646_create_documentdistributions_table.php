<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentdistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentdistributions', function (Blueprint $table) {
            $table->id('documentdistributions_id');
            $table->integer('documentdistributions_listno');
            $table->unsignedBigInteger('documentregisters_id');
            $table->foreign('documentregisters_id')->references('documentregisters_id')->on('documentregisters')->onDelete('cascade');
            $table->unsignedBigInteger('ms_employee_id');
            $table->foreign('ms_employee_id')->references('ms_employee_id')->on('ms_employee')->onDelete('cascade');          
            $table->string('documentdistributions_type');
            $table->date('documentdistributions_date');
            $table->string('person_at');
            $table->boolean('documentdistributions_flag')->default(true); 
            $table->string('approved_at')->nullable();
            $table->string('approved_note')->nullable();
            $table->string('ms_department_name')->nullable();
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
        Schema::dropIfExists('documentdistributions');
    }
}
