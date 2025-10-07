<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignReviewAHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_review_a_hds', function (Blueprint $table) {
            $table->id('design_review_a_hd_id');
            $table->string('design_review_a_hd_product')->nullable();
            $table->string('design_review_a_hd_model')->nullable();
            $table->string('design_review_a_hd_participants')->nullable();
            $table->string('design_review_a_hd_subject')->nullable();
            $table->string('design_review_a_hd_designinput')->nullable();
            $table->string('design_review_a_hd_drawing')->nullable();
            $table->string('design_review_a_hd_reference')->nullable();
            $table->string('design_review_a_hd_comment')->nullable();
            $table->string('reported_by');
            $table->date('reported_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('engineecing_by')->nullable();
            $table->date('engineecing_date')->nullable();
            $table->boolean('design_review_a_hd_flag')->default(true); 
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
        Schema::dropIfExists('design_review_a_hds');
    }
}
