<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordhbHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_recordhb_hds', function (Blueprint $table) {
            $table->id('inspection_recordhb_hds_id');
            $table->string('document_code')->default('GF409.1');
            $table->string('company_name')->default('บริษัท เอสซอม จำกัด');
            $table->string('product_name')->default('HB100 HYDRAULICS BENCH');
            
            // ผู้ตรวจ
            $table->string('checked_by')->nullable();
            $table->string('checked_job')->nullable();
            $table->date('checked_date')->nullable();
            
            // ผู้อนุมัติ
            $table->string('approved_by')->nullable();
            $table->string('approved_job')->nullable();
            $table->date('approved_date')->nullable();
            
            $table->string('status')->default('completed');
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
        Schema::dropIfExists('inspection_recordhb_hds');
    }
}
