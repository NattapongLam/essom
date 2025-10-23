<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsoKnowledgeTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iso_knowledge_transfer', function (Blueprint $table) {
            $table->id();

            $table->string('evaluator_name')->nullable();            
            $table->string('department')->nullable();                 
            $table->string('position')->nullable();                 
            $table->date('record_date')->nullable();                 
            $table->string('doc_no')->nullable();                     
            $table->date('approved_date')->nullable();               
            $table->string('subject')->nullable();                   
            $table->string('organizational_knowledge')->nullable();
            $table->boolean('status_sent')->default(false);          
            $table->date('sent_date')->nullable();                    
            $table->boolean('status_pending')->default(false);        
            $table->date('plan_send_date')->nullable();               
            $table->boolean('status_planning')->default(false);       
            $table->date('plan_complete_date')->nullable();           
            $table->string('transfer_method')->nullable();            
            $table->boolean('eval_understanding_good')->default(false);    
            $table->boolean('eval_understanding_partial')->default(false); 
            $table->boolean('eval_understanding_none')->default(false);    
            $table->boolean('eval_result_pass')->default(false);           
            $table->boolean('eval_result_fail')->default(false);           
            $table->boolean('eval_not_yet')->default(false);               
            $table->boolean('eval_not_done')->default(false);              
            $table->date('re_evaluate_date')->nullable();                 
            $table->text('supervisor_comments')->nullable();               
            $table->boolean('review_current')->default(false);            
            $table->boolean('review_outdated')->default(false);            
            $table->boolean('review_replace')->default(false);             
            $table->boolean('review_freq_monthly')->default(false);        
            $table->boolean('review_freq_6months')->default(false);        
            $table->boolean('review_freq_yearly')->default(false);         
            $table->boolean('review_freq_none')->default(false);           

            $table->string('approved_by')->nullable();         
            $table->date('approved_date_final')->nullable();

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
        Schema::dropIfExists('iso_knowledge_transfer');
    }
}
