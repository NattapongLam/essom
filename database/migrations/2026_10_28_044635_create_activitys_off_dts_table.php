<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysOffDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitys_off_dts', function (Blueprint $table) {
            $table->id('activitys_off_dts_id');
            $table->unsignedBigInteger('activitys_off_hds_id');
            $table->foreign('activitys_off_hds_id')->references('activitys_off_hds_id')->on('activitys_off_hds')->onDelete('cascade');
            $table->string('item_code')->comment('รหัสข้อ เช่น 1.1, 1.2');
            $table->integer('max_score')->default(5)->comment('คะแนนเต็ม');
            $table->integer('score')->comment('คะแนนที่ได้');
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
        Schema::dropIfExists('activitys_off_dts');
    }
}
