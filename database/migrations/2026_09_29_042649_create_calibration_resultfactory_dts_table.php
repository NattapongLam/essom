<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationResultfactoryDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibration_resultfactory_dts', function (Blueprint $table) {
            $table->id('calibration_resultfactory_dts_id');
            $table->unsignedBigInteger('calibration_resultfactory_hds_id');
            $table->foreign('calibration_resultfactory_hds_id')->references('calibration_resultfactory_hds_id')->on('calibration_resultfactory_hds')->onDelete('cascade');
            $table->integer('listno');
            $table->string('standard_value')->nullable();
            $table->string('correct_value')->nullable();
            $table->string('calibration_value')->nullable();
            $table->string('error_value')->nullable();
            $table->string('measured_percent')->nullable();
            $table->string('acceptable_percent')->nullable();
            $table->string('remark')->nullable();
            $table->string('person_at');
            $table->boolean('calibration_resultfactory_dts_flag')->default(true);
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
        Schema::dropIfExists('calibration_resultfactory_dts');
    }
}
