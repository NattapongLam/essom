<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductselectionMasterHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productselection_master_hds', function (Blueprint $table) {
            $table->id('productselection_master_hds_id');
            $table->boolean('productselection_master_hds_flag')->default(true); 
            $table->string('product_type1')->nullable();
            $table->string('product_type2')->nullable();
            $table->string('product_type3')->nullable();
            $table->string('product_type4')->nullable();
            $table->string('productselection_master_hds_type')->nullable();
            $table->string('productselection_master_hds_group')->nullable();
            $table->string('productselection_master_hds_department')->nullable();
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
        Schema::dropIfExists('productselection_master_hds');
    }
}
