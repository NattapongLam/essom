<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualgroupPlanningHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualgroup_planning_hds', function (Blueprint $table) {
            $table->id('individualgroup_planning_hds_id');
            $table->boolean('individualgroup_planning_hds_flag')->default(true);
            $table->string('section')->nullable();
            $table->string('product_code')->nullable();
            $table->string('job_no')->nullable();
            $table->decimal('qty', 18, 2)->default(0);
            $table->string('customer')->nullable();
            $table->string('responsible')->nullable();
            $table->string('budget_time')->nullable();
            $table->date('mh_for_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('remark')->nullable();
            $table->string('month_1')->nullable();
            $table->string('month_2')->nullable();
            $table->string('month_3')->nullable();
            $table->string('prepared_by');
            $table->date('prepared_date');
            $table->string('checked_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('docs_status');
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
        Schema::dropIfExists('individualgroup_planning_hds');
    }
}
