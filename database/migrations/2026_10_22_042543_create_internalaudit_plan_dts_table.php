<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalauditPlanDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalaudit_plan_dts', function (Blueprint $table) {
            $table->id('internalaudit_plan_dts_id');
            $table->unsignedBigInteger('internalaudit_plan_hds_id');
            $table->foreign('internalaudit_plan_hds_id')->references('internalaudit_plan_hds_id')->on('internalaudit_plan_hds')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->string('process')->nullable();
            $table->string('auditee')->nullable();
            $table->string('auditor')->nullable();
            $table->string('person_at');
            $table->boolean('internalaudit_plan_dts_flag')->default(true);
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
        Schema::dropIfExists('internalaudit_plan_dts');
    }
}
