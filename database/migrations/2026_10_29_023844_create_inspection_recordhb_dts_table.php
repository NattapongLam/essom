<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordhbDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_recordhb_dts', function (Blueprint $table) {
            $table->id('inspection_recordhb_dts_id');
            $table->unsignedBigInteger('inspection_recordhb_hds_id');
            $table->foreign('inspection_recordhb_hds_id')->references('inspection_recordhb_hds_id')->on('inspection_recordhb_hds')->onDelete('cascade');
            $table->integer('section_number');
            $table->string('section_title')->nullable();
            $table->json('measurements')->nullable(); // จัดเก็บค่าตัวเลข กว้าง/ยาว/สูง ทั้งหมด
            $table->enum('pass_fail', ['pass', 'fail'])->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('inspection_recordhb_dts');
    }
}
