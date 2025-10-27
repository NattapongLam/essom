<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareDesignDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_design_dts', function (Blueprint $table) {
            $table->id('software_design_dt_id');
            $table->unsignedBigInteger('software_design_hd_id');
            $table->foreign('software_design_hd_id')->references('software_design_hd_id')->on('software_design_hds')->onDelete('cascade');
            $table->integer('listno');
            $table->string('software_design_dt_calculation')->nullable();
            $table->string('software_design_dt_byhand')->nullable();
            $table->string('software_design_dt_display')->nullable();
            $table->string('software_design_dt_error')->nullable();
            $table->string('person_at');
            $table->boolean('software_design_dt_flag')->default(true);
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
        Schema::dropIfExists('software_design_dts');
    }
}
