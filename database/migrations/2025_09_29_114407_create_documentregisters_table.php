<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentregistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentregisters', function (Blueprint $table) {
            $table->id('documentregisters_id');
            $table->integer('documentregisters_listno');
            $table->string('documentregisters_docuno');
            $table->string('documentregisters_remark')->nullable();
            $table->string('documentregisters_rev01')->nullable();
            $table->string('documentregisters_rev02')->nullable();
            $table->string('documentregisters_rev03')->nullable();
            $table->string('documentregisters_rev04')->nullable();
            $table->string('documentregisters_rev05')->nullable();
            $table->string('documentregisters_rev06')->nullable();
            $table->string('documentregisters_rev07')->nullable();
            $table->string('documentregisters_rev08')->nullable();
            $table->string('documentregisters_rev09')->nullable();
            $table->string('documentregisters_rev10')->nullable();
            $table->string('documentregisters_file')->nullable();
            $table->string('person_at');
            $table->boolean('documentregisters_flag')->default(true); 
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
        Schema::dropIfExists('documentregisters');
    }
}
