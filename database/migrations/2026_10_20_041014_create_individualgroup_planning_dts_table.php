<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualgroupPlanningDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualgroup_planning_dts', function (Blueprint $table) {
            $table->id('individualgroup_planning_dts_id');
            $table->unsignedBigInteger('individualgroup_planning_hds_id');
            
            $table->string('description')->nullable(); // รายละเอียดงานแต่ละแถว
            
            // ช่องกรอกข้อมูลตารางหลัก 18 ช่อง (val_0 ถึง val_17)
            for ($i = 0; $i < 18; $i++) {
                $table->string("val_{$i}")->nullable();
            }

            // ค่า Ack และ Date ประจำแต่ละคอลัมน์ (ack_0 ถึง ack_17 และ ack_date_0 ถึง ack_date_17)
            for ($i = 0; $i < 18; $i++) {
                $table->string("ack_{$i}")->nullable();
                $table->date("ack_date_{$i}")->nullable();
            }

            $table->timestamps();

            // Foreign Key เชื่อมกับตาราง Header
            $table->foreign('individualgroup_planning_hds_id')
                  ->references('individualgroup_planning_hds_id')
                  ->on('individualgroup_planning_hds')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('individualgroup_planning_dts');
    }
}
