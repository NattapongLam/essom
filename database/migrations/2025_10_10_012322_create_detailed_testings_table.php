<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailedTestingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailed_testings', function (Blueprint $table) {
            $table->id('detailed_testings_id');
            $table->string('detailed_testings_product');
            $table->string('detailed_testings_code');
            $table->string('detailed_testings_serial')->nullable();
            $table->string('tested_by');
            $table->date('tested_date');
            $table->string('detailed_testings_testdata')->nullable();
            $table->string('detailed_testings_data');
            $table->string('detailed_testings_sample')->nullable();
            $table->string('detailed_testings_drawn')->nullable();
            $table->string('checked_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->string('detailed_testings_comments')->nullable();
            $table->string('signature_by')->nullable();
            $table->date('signature_date')->nullable();
            $table->boolean('detailed_testings_flag')->default(true); 
            $table->string('person_at');
            $table->string('detailed_testings_file')->nullable();
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
        Schema::dropIfExists('detailed_testings');
    }
}
