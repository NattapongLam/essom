<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalauditMasterDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalaudit_master_dts', function (Blueprint $table) {
            $table->id('internalaudit_master_dts_id');
            $table->unsignedBigInteger('internalaudit_master_hds_id');
            $table->foreign('internalaudit_master_hds_id')->references('internalaudit_master_hds_id')->on('internalaudit_master_hds')->onDelete('cascade');
            $table->string('checklist')->nullable();
            $table->string('person_at');
            $table->boolean('internalaudit_master_dts_flag')->default(true);
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
        Schema::dropIfExists('internalaudit_master_dts');
    }
}
