<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentdestructionHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentdestruction_hds', function (Blueprint $table) {
            $table->id('documentdestruction_hd_id');
            $table->date('documentdestruction_hd_date');
            $table->string('documentdestruction_hd_to')->nullable();
            $table->string('documentdestruction_hd_from')->nullable();
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->boolean('documentdestruction_hd_flag')->default(true); 
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
        Schema::dropIfExists('documentdestruction_hds');
    }
}
