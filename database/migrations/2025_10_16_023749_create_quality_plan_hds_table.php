<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityPlanHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_plan_hds', function (Blueprint $table) {
            $table->id('quality_plan_hd_id');
            $table->string('quality_plan_hd_docno')->nullable();
            $table->string('quality_plan_hd_revno')->nullable();
            $table->string('quality_plan_hd_effecdate')->nullable();
            $table->string('quality_plan_hd_page')->nullable();
            $table->boolean('quality_plan_hd_flag')->default(true); 
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
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
        Schema::dropIfExists('quality_plan_hds');
    }
}
