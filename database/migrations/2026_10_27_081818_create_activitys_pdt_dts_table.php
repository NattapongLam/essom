<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysPdtDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitys_pdt_dts', function (Blueprint $table) {
            $table->id('activitys_pdt_dts_id');
            $table->unsignedBigInteger('activitys_pdt_hds_id');
            $table->foreign('activitys_pdt_hds_id')->references('activitys_pdt_hds_id')->on('activitys_pdt_hds')->onDelete('cascade');
            $table->string('category')->nullable();
            $table->integer('item_no');
            $table->text('description')->nullable();
            $table->integer('max_score')->default(5);
            $table->integer('score')->nullable();
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
        Schema::dropIfExists('activitys_pdt_dts');
    }
}
