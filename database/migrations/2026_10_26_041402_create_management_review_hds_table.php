<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementReviewHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_review_hds', function (Blueprint $table) {
            $table->id('management_review_hds_id');
            $table->boolean('management_review_hds_flag')->default(true);
            $table->date('issue_date')->nullable();
            $table->string('management_review_hds_no')->nullable();
            $table->date('management_review_hds_date')->nullable();
            $table->string('management_review_hds_time')->nullable();
            $table->string('management_review_hds_location')->nullable();
            $table->string('prepared_by')->nullable();
            $table->date('prepared_date')->nullable();
            $table->string('checked_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->string('docs_status');
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
        Schema::dropIfExists('management_review_hds');
    }
}
