<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductselectionMasterDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productselection_master_dts', function (Blueprint $table) {
            $table->id('productselection_master_dts_id');
            $table->unsignedBigInteger('productselection_master_hds_id');
            $table->foreign('productselection_master_hds_id')->references('productselection_master_hds_id')->on('productselection_master_hds')->onDelete('cascade');
            $table->integer('productselection_master_dts_listno');
            $table->string('productselection_master_dts_vendor');
            $table->string('productselection_master_dts_vendor_name')->nullable();
            $table->string('productselection_master_dts_vendor_tel')->nullable();
            $table->string('productselection_master_dts_vendor_email')->nullable();
            $table->string('productselection_master_dts_vendor_remark')->nullable();
            $table->string('productselection_master_dts_brand')->nullable();
            $table->boolean('productselection_master_dts_grade_a')->default(false); 
            $table->string('productselection_master_dts_grade_b')->nullable(); 
            $table->boolean('productselection_master_dts_grade_c')->default(false); 
            $table->boolean('productselection_master_dts_results1')->default(false); 
            $table->boolean('productselection_master_dts_results2')->default(false); 
            $table->boolean('productselection_master_dts_results3')->default(false); 
            $table->string('productselection_master_dts_remark')->nullable();
            $table->boolean('productselection_master_dts_flag')->default(true); 
            $table->string('person_at');
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
        Schema::dropIfExists('productselection_master_dts');
    }
}
