<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalauditReportHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalaudit_report_hds', function (Blueprint $table) {
            $table->id('internalaudit_report_hds_id');
            $table->boolean('internalaudit_report_hds_flag')->default(true);
            $table->string('document_no')->nullable();
            $table->string('document_name')->nullable();
            $table->string('revision')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('auditor_name')->nullable();
            $table->date('auditor_date')->nullable();
            $table->string('auditee_name')->nullable();
            $table->date('auditee_date')->nullable();
            $table->string('approver_name')->nullable();
            $table->date('approver_date')->nullable();
            $table->string('docs_status');
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
        Schema::dropIfExists('internalaudit_report_hds');
    }
}
