<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_record_dts', function (Blueprint $table) {
            $table->id('inspection_record_dts_id');
            $table->unsignedBigInteger('inspection_record_hds_id');
            $table->foreign('inspection_record_hds_id')->references('inspection_record_hds_id')->on('inspection_record_hds')->onDelete('cascade');
            $table->tinyInteger('section_no'); // ข้อที่ (1, 2, 3, 4)
            $table->string('item_name')->nullable(); // ชื่อหัวข้อหรือระดับ (เช่น 20%, 40%, ตัวที่ 1, ตัวที่ 2)
            $table->string('sample_code')->nullable(); // ช่องระบุ "ตัวที่: [ ... ]" ของแต่ละหัวข้อ
            
            // ข้อมูลช่องกรอกการวัด (รองรับทศนิยม)
            $table->string('val_1')->nullable(); 
            $table->string('val_2')->nullable();
            $table->string('val_3')->nullable();
            $table->string('val_4')->nullable();
            $table->string('val_5')->nullable();
            $table->string('val_6')->nullable(); // รองรับช่องที่เพิ่มเข้ามา (เช่น 1000 มม.)

            $table->string('pass_fail')->nullable(); // pass หรือ fail
            $table->text('remarks')->nullable(); // หมายเหตุประจำหัวข้อ
            $table->boolean('is_checked')->default(false); //
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
        Schema::dropIfExists('inspection_record_dts');
    }
}
