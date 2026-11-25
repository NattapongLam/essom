<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualgroupMasterDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualgroup_master_dts', function (Blueprint $table) {
            $table->id('individualgroup_master_dts_id');
            $table->unsignedBigInteger('individualgroup_master_hds_id');
            $table->foreign('individualgroup_master_hds_id')->references('individualgroup_master_hds_id')->on('individualgroup_master_hds')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->boolean('individualgroup_master_dts_flag')->default(true);
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
        Schema::dropIfExists('individualgroup_master_dts');
    }
}
