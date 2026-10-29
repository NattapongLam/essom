<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordsdmDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_recordsdm_dts', function (Blueprint $table) {
            $table->id('inspection_recordsdm_dts_id');
            $table->unsignedBigInteger('inspection_recordsdm_hds_id');
            $table->foreign('inspection_recordsdm_hds_id')->references('inspection_recordsdm_hds_id')->on('inspection_recordsdm_hds')->onDelete('cascade');
            $table->integer('section_no'); // หัวข้อที่ 1, 2, 3...
            $table->text('item_name'); // ชื่อรายการตรวจ
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
        Schema::dropIfExists('inspection_recordsdm_dts');
    }
}
