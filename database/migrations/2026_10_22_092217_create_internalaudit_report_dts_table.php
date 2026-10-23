<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalauditReportDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalaudit_report_dts', function (Blueprint $table) {
            $table->id('internalaudit_report_dts_id');
            $table->unsignedBigInteger('internalaudit_report_hds_id');
            $table->foreign('internalaudit_report_hds_id')->references('internalaudit_report_hds_id')->on('internalaudit_report_hds')->onDelete('cascade');
            $table->string('checklist')->nullable();
            $table->string('finding')->nullable();
            $table->string('conclusion')->nullable();
            $table->string('comment')->nullable();
            $table->string('acknowledgement')->nullable();
            $table->string('person_at');
            $table->boolean('internalaudit_report_dts_flag')->default(true);
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
        Schema::dropIfExists('internalaudit_report_dts');
    }
}
