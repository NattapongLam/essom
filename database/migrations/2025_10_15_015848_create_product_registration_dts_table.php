<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRegistrationDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_registration_dts', function (Blueprint $table) {
            $table->id('product_registration_dt_id');
            $table->unsignedBigInteger('product_registration_hd_id');
            $table->foreign('product_registration_hd_id')->references('product_registration_hd_id')->on('product_registration_hds')->onDelete('cascade');
            $table->integer('product_registration_dt_listno');
            $table->string('product_registration_dt_dwgno')->nullable();
            $table->string('product_registration_dt_description')->nullable();
            $table->string('product_registration_dt_rev00')->nullable();
            $table->string('product_registration_dt_rev01')->nullable();
            $table->string('product_registration_dt_rev02')->nullable();
            $table->string('product_registration_dt_rev03')->nullable();
            $table->string('product_registration_dt_rev04')->nullable();
            $table->string('product_registration_dt_rev05')->nullable();
            $table->string('product_registration_dt_rev06')->nullable();
            $table->string('product_registration_dt_rev07')->nullable();
            $table->string('product_registration_dt_rev08')->nullable();
            $table->string('product_registration_dt_rev09')->nullable();
            $table->string('product_registration_dt_rev10')->nullable();
            $table->string('product_registration_dt_file')->nullable();
            $table->boolean('product_registration_dt_flag')->default(true); 
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
        Schema::dropIfExists('product_registration_dts');
    }
}
