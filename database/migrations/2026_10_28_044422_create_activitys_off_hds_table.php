<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysOffHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitys_off_hds', function (Blueprint $table) {
            $table->id('activitys_off_hds_id');
            $table->boolean('activitys_off_hds_flag')->default(true);
            $table->string('department_name')->comment('หน่วยงานที่ถูกตรวจ');
            $table->string('floor')->comment('ชั้นที่ถูกตรวจ');
            
            // เก็บรายการคะแนนรายข้อ (1.1 - 3.6) ในรูปแบบ JSON
            $table->json('scores')->comment('คะแนนรายข้อ [score_key => score]');
            
            $table->integer('total_score')->default(0)->comment('คะแนนรวม');
            $table->decimal('percentage_score', 5, 2)->default(0.00)->comment('คะแนนคิดเป็น %');
            
            $table->text('strength')->nullable()->comment('จุดเด่นจากการตรวจพื้นที่');
            $table->text('weakness')->nullable()->comment('จุดด้อยจากการตรวจพื้นที่');
            $table->text('suggestion')->nullable()->comment('ข้อเสนอแนะจากการตรวจพื้นที่');
            
            $table->string('auditor_1')->comment('กรรมการตรวจท่านที่ 1');
            $table->string('auditor_2')->nullable()->comment('กรรมการตรวจท่านที่ 2');
            $table->date('audit_date')->comment('วันที่ตรวจ');
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
        Schema::dropIfExists('activitys_off_hds');
    }
}
