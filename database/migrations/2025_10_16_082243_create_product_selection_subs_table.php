<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectionSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selection_subs', function (Blueprint $table) {
            $table->id('product_selection_sub_id');
            $table->unsignedBigInteger('product_selection_hd_id');
            $table->foreign('product_selection_hd_id')->references('product_selection_hd_id')->on('product_selection_hds')->onDelete('cascade');
            $table->integer('product_selection_sub_listno');
            $table->string('product_selection_sub_name');
            $table->boolean('product_selection_hd_results1_1')->default(false); 
            $table->boolean('product_selection_hd_results1_2')->default(false); 
            $table->boolean('product_selection_hd_results1_3')->default(false); 
            $table->boolean('product_selection_hd_results2_1')->default(false); 
            $table->boolean('product_selection_hd_results2_2')->default(false); 
            $table->boolean('product_selection_hd_results2_3')->default(false); 
            $table->boolean('product_selection_hd_results3_1')->default(false); 
            $table->boolean('product_selection_hd_results3_2')->default(false); 
            $table->boolean('product_selection_hd_results3_3')->default(false); 
            $table->boolean('product_selection_hd_results4_1')->default(false); 
            $table->boolean('product_selection_hd_results4_2')->default(false);
            $table->boolean('product_selection_hd_results4_3')->default(false);
            $table->integer('product_selection_sub_vendorlistno');
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
        Schema::dropIfExists('product_selection_subs');
    }
}
