<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientSelectionHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient_selection_hds', function (Blueprint $table) {
            $table->id('recipient_selection_hd_id');
            $table->string('recipient_selection_hd_name')->nullable();
            $table->string('recipient_selection_hd_address')->nullable();
            $table->string('recipient_selection_hd_contact')->nullable();
            $table->string('recipient_selection_hd_tel')->nullable();
            $table->string('recipient_selection_hd_email')->nullable();
            $table->string('location_house')->nullable();
            $table->string('location_rowhouse')->nullable();
            $table->string('location_factory')->nullable();
            $table->string('location_other')->nullable();
            $table->string('tool_lathe')->nullable();
            $table->string('tool_milling')->nullable();
            $table->string('tool_electricwelding')->nullable();
            $table->string('tool_co2welding')->nullable();
            $table->string('tool_argonwelding')->nullable();
            $table->string('tool_gas')->nullable();
            $table->string('tool_metalwinding')->nullable();
            $table->string('tool_metalcutting')->nullable();
            $table->string('tool_metalfolding')->nullable();
            $table->string('tool_pipecutting')->nullable();
            $table->string('tool_metalpolisher')->nullable();
            $table->string('tool_metaldrilling')->nullable();
            $table->string('tool_measuring')->nullable();
            $table->string('tool_laser')->nullable();
            $table->string('tool_other')->nullable();
            $table->string('person_engineer')->nullable();
            $table->string('person_manager')->nullable();
            $table->string('person_tradesman1')->nullable();
            $table->string('person_tradesman2')->nullable();
            $table->string('person_tradesman3')->nullable();
            $table->string('person_tradesman4')->nullable();
            $table->string('person_tradesman5')->nullable();
            $table->boolean('job_lathe')->default(false);
            $table->boolean('job_milling')->default(false);
            $table->boolean('job_drill')->default(false);
            $table->boolean('job_roll')->default(false);
            $table->boolean('job_cut')->default(false);
            $table->boolean('job_fold')->default(false);
            $table->boolean('job_link')->default(false);
            $table->boolean('job_handsome')->default(false);
            $table->boolean('job_assemble')->default(false);
            $table->boolean('job_repair')->default(false);
            $table->boolean('job_paint')->default(false);
            $table->boolean('job_lasercutting')->default(false);
            $table->boolean('job_other')->default(false);
            $table->string('recipient_selection_hd_file')->nullable();
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('approved_by1')->nullable();
            $table->date('approved_date1')->nullable();
            $table->string('recipient_selection_hd_remark')->nullable();
            $table->string('assessor_by')->nullable();
            $table->date('assessor_date')->nullable();
            $table->string('approved_by2')->nullable();
            $table->date('approved_date2')->nullable();
            $table->boolean('recipient_selection_hd_flag')->default(true); 
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
        Schema::dropIfExists('recipient_selection_hds');
    }
}
