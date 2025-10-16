<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityPlanDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_plan_dts', function (Blueprint $table) {
            $table->id('quality_plan_dt_id');
            $table->unsignedBigInteger('quality_plan_hd_id');
            $table->foreign('quality_plan_hd_id')->references('quality_plan_hd_id')->on('quality_plan_hds')->onDelete('cascade');
            $table->integer('quality_plan_dt_listno');
            $table->string('quality_plan_dt_description');
            $table->string('quality_plan_dt_tool')->nullable();
            $table->string('quality_plan_dt_by');
            $table->string('quality_plan_dt_reference')->nullable();
            $table->boolean('quality_plan_dt_flag')->default(true); 
            $table->string('person_at');
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
        Schema::dropIfExists('quality_plan_dts');
    }
}
