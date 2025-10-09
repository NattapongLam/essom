<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignReviewBSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_review_b_s', function (Blueprint $table) {
            $table->id('design_review_b_id');
            $table->unsignedBigInteger('design_review_a_hd_id');
            $table->foreign('design_review_a_hd_id')->references('design_review_a_hd_id')->on('design_review_a_hds')->onDelete('cascade');
            $table->string('design_review_b_input');
            $table->string('design_review_b_output');
            $table->string('design_review_b_remark')->nullable();
            $table->string('design_review_b_comment')->nullable();
            $table->string('reported_by');
            $table->date('reported_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('engineecing_by')->nullable();
            $table->date('engineecing_date')->nullable();
            $table->boolean('design_review_b_flag')->default(true); 
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
        Schema::dropIfExists('design_review_b_s');
    }
}
