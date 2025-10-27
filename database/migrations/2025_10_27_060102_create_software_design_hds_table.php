<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareDesignHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software_design_hds', function (Blueprint $table) {
            $table->id('software_design_hd_id');
            $table->string('software_design_hd_no');
            $table->string('software_design_hd_product');
            $table->string('software_design_hd_reference')->nullable();
            $table->string('software_design_hd_input')->nullable();
            $table->string('software_design_hd_output')->nullable();
            $table->string('software_design_hd_layout')->nullable();
            $table->string('prepared_by1');
            $table->date('prepared_date1');
            $table->string('reviewed_by1')->nullable();
            $table->date('reviewed_date1')->nullable();
            $table->string('software_design_hd_comment')->nullable();
            $table->string('prepared_by2')->nullable();
            $table->date('prepared_date2')->nullable();
            $table->string('reviewed_by2')->nullable();
            $table->date('reviewed_date2')->nullable();
            $table->string('initialapproval_by')->nullable();
            $table->date('initialapproval_date')->nullable();
            $table->string('finalapproval_by')->nullable();
            $table->date('finalapproval_date')->nullable();
            $table->boolean('software_design_hd_flag')->default(true);
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
        Schema::dropIfExists('software_design_hds');
    }
}
