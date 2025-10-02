<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentcorrectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentcorrections', function (Blueprint $table) {
            $table->id('documentcorrections_id');
            $table->string('documentcorrections_type');
            $table->string('documentcorrections_docuno');
            $table->date('documentcorrections_date');
            $table->string('documentcorrections_to')->nullable();
            $table->string('documentcorrections_from')->nullable();
            $table->BigInteger('documentregisters_id')->nullable();
            $table->string('documentcorrections_name');
            $table->string('documentcorrections_torev')->nullable();
            $table->string('documentcorrections_fromrev')->nullable();
            $table->date('documentcorrections_effectivedate')->nullable();
            $table->string('documentcorrections_previous')->nullable();
            $table->string('documentcorrections_revision')->nullable();
            $table->string('documentcorrections_note')->nullable();
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('documentcorrections_auditcheck')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('reviewed_comment')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->boolean('documentcorrections_flag')->default(true); 
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
        Schema::dropIfExists('documentcorrections');
    }
}
