<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductselectionMasterSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productselection_master_subs', function (Blueprint $table) {
            $table->id('productselection_master_subs_id');
            $table->unsignedBigInteger('productselection_master_hds_id');
            $table->foreign('productselection_master_hds_id')->references('productselection_master_hds_id')->on('productselection_master_hds')->onDelete('cascade');
            $table->integer('productselection_master_subs_listno');
            $table->string('productselection_master_subs_name');
            $table->boolean('productselection_master_subs_results1_1')->default(false); 
            $table->boolean('productselection_master_subs_results1_2')->default(false); 
            $table->boolean('productselection_master_subs_results1_3')->default(false); 
            $table->boolean('productselection_master_subs_results2_1')->default(false); 
            $table->boolean('productselection_master_subs_results2_2')->default(false); 
            $table->boolean('productselection_master_subs_results2_3')->default(false); 
            $table->boolean('productselection_master_subs_results3_1')->default(false); 
            $table->boolean('productselection_master_subs_results3_2')->default(false); 
            $table->boolean('productselection_master_subs_results3_3')->default(false); 
            $table->boolean('productselection_master_subs_results4_1')->default(false); 
            $table->boolean('productselection_master_subs_results4_2')->default(false);
            $table->boolean('productselection_master_subs_results4_3')->default(false);
            $table->integer('productselection_master_subs_vendorlistno');
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
        Schema::dropIfExists('productselection_master_subs');
    }
}
