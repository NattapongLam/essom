<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalauditMasterHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internalaudit_master_hds', function (Blueprint $table) {
            $table->id('internalaudit_master_hds_id');
            $table->boolean('internalaudit_master_hds_flag')->default(true);
            $table->string('document_no')->nullable();
            $table->string('document_name')->nullable();
            $table->string('revision')->nullable();
            $table->date('effective_date')->nullable();
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
        Schema::dropIfExists('internalaudit_master_hds');
    }
}
