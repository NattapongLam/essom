<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalibrationResultfactoryHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calibration_resultfactory_hds', function (Blueprint $table) {
            $table->id('calibration_resultfactory_hds_id');
            $table->string('docutype');
            $table->string('calibration_name');
            $table->string('calibration_code');
            $table->string('calibration_brand')->nullable();
            $table->date('calibration_resultfactory_hds_date');
            $table->string('standard_tools')->nullable();
            $table->string('room_temperature')->nullable();
            $table->string('atmospheric_pressur')->nullable();
            $table->string('measurement_scales')->nullable();
            $table->string('additional_details')->nullable();
            $table->string('standard_unit')->nullable();
            $table->string('value_unit')->nullable();
            $table->string('equipment_unit')->nullable();
            $table->string('error_unit')->nullable();
            $table->string('evaluation_round')->nullable();
            $table->string('approved_at')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('final_approval')->nullable();
            $table->boolean('calibration_resultfactory_hds_flag')->default(true);
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
        Schema::dropIfExists('calibration_resultfactory_hds');
    }
}
