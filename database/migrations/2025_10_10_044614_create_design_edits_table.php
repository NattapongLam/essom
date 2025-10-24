<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignEditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('design_edits', function (Blueprint $table) {
            $table->id('design_edits_id');
            $table->string('design_edits_product');
            $table->string('design_edits_model');
            $table->string('design_edits_drawing');
            $table->string('design_edits_reasons');
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('supervisor_by')->nullable();
            $table->date('supervisor_date')->nullable();
            $table->string('engineeringsection_comments')->nullable();
            $table->string('engineeringsection_by')->nullable();
            $table->date('engineeringsection_date')->nullable();
            $table->string('engineer_comments')->nullable();
            $table->string('engineer_by')->nullable();
            $table->date('engineer_date')->nullable();            
            $table->string('seniorengineer_comments')->nullable();
            $table->string('seniorengineer_by')->nullable();
            $table->date('seniorengineer_date')->nullable();
            $table->boolean('design_edits_flag')->default(true); 
            $table->string('person_at');
            $table->string('design_edits_file')->nullable();
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
        Schema::dropIfExists('design_edits');
    }
}
