<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectionDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selection_dts', function (Blueprint $table) {
            $table->id('product_selection_dt_id');
            $table->unsignedBigInteger('product_selection_hd_id');
            $table->foreign('product_selection_hd_id')->references('product_selection_hd_id')->on('product_selection_hds')->onDelete('cascade');
            $table->integer('product_selection_dt_listno');
            $table->string('product_selection_dt_vendor');
            $table->string('product_selection_dt_vendor_name')->nullable();
            $table->string('product_selection_dt_vendor_tel')->nullable();
            $table->string('product_selection_dt_vendor_email')->nullable();
            $table->string('product_selection_dt_vendor_remark')->nullable();
            $table->string('product_selection_dt_brand')->nullable();
            $table->boolean('product_selection_hd_grade_a')->default(false); 
            $table->string('product_selection_hd_grade_b')->nullable(); 
            $table->boolean('product_selection_hd_grade_c')->default(false); 
            $table->boolean('product_selection_hd_results1')->default(false); 
            $table->boolean('product_selection_hd_results2')->default(false); 
            $table->boolean('product_selection_hd_results3')->default(false); 
            $table->string('product_selection_dt_remark')->nullable();
            $table->boolean('product_selection_dt_flag')->default(true); 
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
        Schema::dropIfExists('product_selection_dts');
    }
}
