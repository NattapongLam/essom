<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentexternalHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentexternal_hds', function (Blueprint $table) {
            $table->id('documentexternal_hd_id');
            $table->string('ms_year_name');
            $table->string('person_at');
            $table->boolean('documentexternal_hd_flag')->default(true); 
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
        Schema::dropIfExists('documentexternal_hds');
    }
}
