<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentexternalDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentexternal_dts', function (Blueprint $table) {
            $table->id('documentexternal_dt_id');
            $table->unsignedBigInteger('documentexternal_hd_id');
            $table->foreign('documentexternal_hd_id')->references('documentexternal_hd_id')->on('documentexternal_hds')->onDelete('cascade');
            $table->string('documentdestruction_dt_receive')->nullable();
            $table->string('documentdestruction_dt_sentfrom')->nullable();
            $table->string('documentdestruction_dt_department')->nullable();
            $table->string('documentdestruction_dt_subject')->nullable();
            $table->string('documentdestruction_dt_howtosend')->nullable();
            $table->string('documentdestruction_dt_until')->nullable();
            $table->string('documentdestruction_dt_set')->nullable();
            $table->string('documentdestruction_dt_recipient')->nullable();            
            $table->string('person_at');
            $table->boolean('documentexternal_dt_flag')->default(true); 
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
        Schema::dropIfExists('documentexternal_dts');
    }
}
