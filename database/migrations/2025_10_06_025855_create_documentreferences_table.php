<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentreferences', function (Blueprint $table) {
            $table->id('documentreferences_id');
            $table->integer('documentreferences_listno');
            $table->date('documentreferences_receivedate');
            $table->string('documentreferences_department')->nullable();
            $table->string('documentreferences_name')->nullable();
            $table->string('documentreferences_code')->nullable();
            $table->date('documentreferences_date')->nullable();
            $table->string('person_at');
            $table->boolean('documentreferences_flag')->default(true); 
            $table->string('documentreferences_file')->nullable();
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
        Schema::dropIfExists('documentreferences');
    }
}
