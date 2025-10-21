<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductListSelectedDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_list_selected_dts', function (Blueprint $table) {
            $table->id('product_list_selected_dt_id');
            $table->unsignedBigInteger('product_list_selected_hd_id');
            $table->foreign('product_list_selected_hd_id')->references('product_list_selected_hd_id')->on('product_list_selected_hds')->onDelete('cascade');
            $table->integer('product_list_selected_dt_listno');
            $table->string('product_list_selected_dt_vendor');
            $table->string('product_list_selected_dt_product');
            $table->boolean('product_list_selected_dt_results1')->default(false); 
            $table->boolean('product_list_selected_dt_results2')->default(false); 
            $table->boolean('product_list_selected_dt_results3')->default(false); 
            $table->boolean('product_list_selected_dt_results4')->default(false); 
            $table->boolean('product_list_selected_dt_results5')->default(false); 
            $table->string('person_at');
            $table->boolean('product_list_selected_dt_flag')->default(true); 
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
        Schema::dropIfExists('product_list_selected_dts');
    }
}
