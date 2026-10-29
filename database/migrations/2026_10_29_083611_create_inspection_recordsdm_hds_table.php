<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionRecordsdmHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_recordsdm_hds', function (Blueprint $table) {
            $table->id('inspection_recordsdm_hds_id');
            $table->string('doc_number')->nullable(); // เลขที่เอกสาร/ฟอร์ม เช่น GF409 SDM
            $table->string('company_name')->default('ESSOM CO., LTD');
            $table->string('checked_by')->nullable();
            $table->string('checked_job')->nullable();
            $table->date('checked_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('approved_job')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('overall_status');
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
        Schema::dropIfExists('inspection_recordsdm_hds');
    }
}
