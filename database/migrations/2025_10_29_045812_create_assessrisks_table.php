<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessrisksTable extends Migration
{
    public function up()
    {
        Schema::create('assessrisks', function (Blueprint $table) {
            $table->id();

            $table->string('process_ref')->nullable();
            $table->string('proposed_by')->nullable();
            $table->date('proposed_date')->nullable();

            $table->string('risk_issue')->nullable();
            $table->string('risk_cause')->nullable();
            $table->string('risk_impact')->nullable();
            $table->string('risk_accept_reason')->nullable();

            $table->string('pre_i_1')->nullable();
            $table->string('pre_l_1')->nullable();
            $table->string('pre_level_1')->nullable();
            $table->string('pre_result_1')->nullable();
            $table->string('pre_by_1')->nullable();
            $table->date('pre_date_1')->nullable();

            $table->string('pre_i_2')->nullable();
            $table->string('pre_l_2')->nullable();
            $table->string('pre_level_2')->nullable();
            $table->string('pre_result_2')->nullable();
            $table->string('pre_by_2')->nullable();
            $table->date('pre_date_2')->nullable();

            $table->string('pre_i_3')->nullable();
            $table->string('pre_l_3')->nullable();
            $table->string('pre_level_3')->nullable();
            $table->string('pre_result_3')->nullable();
            $table->string('pre_by_3')->nullable();
            $table->date('pre_date_3')->nullable();

            $table->string('mitigation_1')->nullable();
            $table->string('mitigation_2')->nullable();
            $table->string('mitigation_3')->nullable();

            $table->string('summary_1')->nullable();
            $table->string('summary_2')->nullable();
            $table->string('summary_3')->nullable();

            $table->string('followup_1')->nullable();
            $table->string('followup_2')->nullable();
            $table->string('followup_3')->nullable();

            $table->string('approved_by_1')->nullable();
            $table->date('approved_date_1')->nullable();
            $table->string('approved_by_2')->nullable();
            $table->date('approved_date_2')->nullable();
            $table->string('approved_by_3')->nullable();
            $table->date('approved_date_3')->nullable();

            $table->string('post_i_1')->nullable();
            $table->string('post_l_1')->nullable();
            $table->string('post_level_1')->nullable();
            $table->string('post_result_1')->nullable();
            $table->string('post_by_1')->nullable();
            $table->date('post_date_1')->nullable();

            $table->string('post_i_2')->nullable();
            $table->string('post_l_2')->nullable();
            $table->string('post_level_2')->nullable();
            $table->string('post_result_2')->nullable();
            $table->string('post_by_2')->nullable();
            $table->date('post_date_2')->nullable();

            $table->string('post_i_3')->nullable();
            $table->string('post_l_3')->nullable();
            $table->string('post_level_3')->nullable();
            $table->string('post_result_3')->nullable();
            $table->string('post_by_3')->nullable();
            $table->date('post_date_3')->nullable();

            $table->string('ack_name_1')->nullable();
            $table->date('ack_date_1')->nullable();
            $table->string('ack_name_2')->nullable();
            $table->date('ack_date_2')->nullable();
            $table->string('ack_name_3')->nullable();
            $table->date('ack_date_3')->nullable();

            $table->string('ack_final_name_1')->nullable();
            $table->date('ack_final_date_1')->nullable();
            $table->string('ack_final_name_2')->nullable();
            $table->date('ack_final_date_2')->nullable();
            $table->string('ack_final_name_3')->nullable();
            $table->date('ack_final_date_3')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assessrisks');
    }
}
