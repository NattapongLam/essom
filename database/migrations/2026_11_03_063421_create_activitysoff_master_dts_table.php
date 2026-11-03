<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysoffMasterDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitysoff_master_dts', function (Blueprint $table) {
            $table->id('activitysoff_master_dts_id');
            $table->unsignedBigInteger('activitysoff_master_hds_id');
            $table->foreign('activitysoff_master_hds_id')->references('activitysoff_master_hds_id')->on('activitysoff_master_hds')->onDelete('cascade');
            $table->string('code');
            $table->string('detail');
            $table->integer('score');
            $table->boolean('activitysoff_master_dts_flag')->default(true);
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
        Schema::dropIfExists('activitysoff_master_dts');
    }
}
