<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElemchptggroupPlanningDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemchptggroup_planning_dts', function (Blueprint $table) {
            $table->id('elemchptggroup_planning_dts_id');
            
            // แก้ไขตรงนี้: ระบุชื่อตารางและชื่อคอลัมน์อ้างอิงให้ถูกต้องตามที่คุณตั้งชื่อ
            $table->unsignedBigInteger('elemchptggroup_planning_hds_id');
            $table->foreign('elemchptggroup_planning_hds_id', 'fk_planning_hds_id')
                ->references('elemchptggroup_planning_hds_id')
                ->on('elemchptggroup_planning_hds')
                ->onDelete('cascade');

            $table->tinyInteger('set_no'); // ชุดที่ 1, 2, 3
            $table->string('section')->nullable();
            $table->string('product_code')->nullable();
            $table->string('job_no')->nullable();
            $table->integer('qty')->nullable();
            $table->string('customer')->nullable();
            $table->string('responsible')->nullable();
            $table->string('budget_time')->nullable();
            $table->date('mh_for_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('month_1')->nullable(); 
            $table->json('details')->nullable();    
            $table->json('ack')->nullable();        
            $table->json('ack_date')->nullable();   
            $table->json('weekly_review')->nullable(); 
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
        Schema::dropIfExists('elemchptggroup_planning_dts');
    }
}
