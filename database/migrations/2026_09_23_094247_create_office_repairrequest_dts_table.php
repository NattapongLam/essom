<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeRepairrequestDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_repairrequest_dts', function (Blueprint $table) {
            $table->id('office_repairrequest_dts_id');
            $table->integer('detail_no');
            $table->string('symptom_detail');
            $table->string('repair_action');
            $table->string('remark')->nullable();
            $table->boolean('office_repairrequest_dts_flag')->default(true);
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
        Schema::dropIfExists('office_repairrequest_dts');
    }
}
