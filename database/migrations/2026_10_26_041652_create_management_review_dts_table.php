<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementReviewDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_review_dts', function (Blueprint $table) {
            $table->id('management_review_dts_id');
            $table->unsignedBigInteger('management_review_hds_id');
            $table->foreign('management_review_hds_id')->references('management_review_hds_id')->on('management_review_hds')->onDelete('cascade');
            $table->string('agenda_topic')->nullable();
            $table->string('agenda_type')->nullable();
            $table->string('reporter')->nullable();
            $table->string('chairman')->nullable();
            $table->string('agenda_time')->nullable();
            $table->string('person_at');
            $table->boolean('management_review_dts_flag')->default(true);
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
        Schema::dropIfExists('management_review_dts');
    }
}
