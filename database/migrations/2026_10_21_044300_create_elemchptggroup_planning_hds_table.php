<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElemchptggroupPlanningHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elemchptggroup_planning_hds', function (Blueprint $table) {
            $table->id('elemchptggroup_planning_hds_id');
            $table->boolean('elemchptggroup_planning_hds_flag')->default(true);
            $table->string('prepared_by')->nullable();
            $table->date('prepared_date')->nullable();
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
        Schema::dropIfExists('elemchptggroup_planning_hds');
    }
}
