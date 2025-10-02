<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentdestructionDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentdestruction_dts', function (Blueprint $table) {
            $table->id('documentdestruction_dt_id');
            $table->unsignedBigInteger('documentdestruction_hd_id');
            $table->foreign('documentdestruction_hd_id')->references('documentdestruction_hd_id')->on('documentdestruction_hds')->onDelete('cascade');
            $table->integer('documentdestruction_dt_listno');
            $table->string('documentdestruction_dt_code');
            $table->string('documentdestruction_dt_name');
            $table->string('documentdestruction_dt_note')->nullable();
            $table->boolean('documentdestruction_dt_flag')->default(true); 
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
        Schema::dropIfExists('documentdestruction_dts');
    }
}
