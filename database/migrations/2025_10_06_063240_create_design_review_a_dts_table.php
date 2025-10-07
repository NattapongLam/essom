<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignReviewADtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_review_a_dts', function (Blueprint $table) {
            $table->id('design_review_a_dt_id');
            $table->unsignedBigInteger('design_review_a_hd_id');
            $table->foreign('design_review_a_hd_id')->references('design_review_a_hd_id')->on('design_review_a_hds')->onDelete('cascade');
            $table->string('design_review_a_dt_item')->nullable();
            $table->string('design_review_a_dt_description')->nullable();
            $table->boolean('design_review_a_dt_flag')->default(true); 
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
        Schema::dropIfExists('design_review_a_dts');
    }
}
