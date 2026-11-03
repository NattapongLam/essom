<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysoffMasterHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitysoff_master_hds', function (Blueprint $table) {
            $table->id('activitysoff_master_hds_id');
            $table->boolean('activitysoff_master_hds_flag')->default(true);
            $table->string('department_name')->comment('หน่วยงานที่ถูกตรวจ');
            $table->string('floor')->comment('ชั้นที่ถูกตรวจ');
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
        Schema::dropIfExists('activitysoff_master_hds');
    }
}
