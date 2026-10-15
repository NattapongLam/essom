<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeRepairrequestHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_repairrequest_hds', function (Blueprint $table) {
            $table->id('office_repairrequest_hds_id');
            $table->string('equipment_name');
            $table->string('equipment_code');
            $table->date('notification_date');
            $table->string('notification_person');
            $table->string('receiver_name')->nullable();
            $table->string('receiver_status')->nullable();
            $table->string('tracking_status')->nullable();
            $table->string('tracking_remark')->nullable();
            $table->string('approver_name')->nullable();
            $table->string('approver_remark')->nullable();
            $table->string('approver_status')->nullable();
            $table->string('staff_opinion')->nullable();
            $table->date('completed_date')->nullable();
            $table->string('cannot_repair_reason')->nullable();
            $table->string('docs_status')->nullable();
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
        Schema::dropIfExists('office_repairrequest_hds');
    }
}
