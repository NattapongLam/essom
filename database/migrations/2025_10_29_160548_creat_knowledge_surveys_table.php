<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knowledge_surveys', function (Blueprint $table) {
            $table->id();

            $table->string('surveyor_name')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->date('survey_date')->nullable();
            $table->string('survey_number')->nullable();

            // ข้อ 1
            $table->string('q1_department_field')->nullable();
            $table->json('q1_status')->nullable();            
            $table->string('q1_doc_no')->nullable();          
            $table->string('q1_storage_location')->nullable();
            $table->string('q1_transfer_method')->nullable();
            $table->date('q1_transfer_date')->nullable();
            $table->string('q1_comment')->nullable();
            $table->date('q1_comment_date')->nullable();
            $table->date('q1_progress_date')->nullable();

            // ข้อ 2
            $table->string('q2_department_field')->nullable();
            $table->json('q2_status')->nullable();
            $table->string('q2_doc_no')->nullable();
            $table->string('q2_storage_location')->nullable();
            $table->string('q2_transfer_method')->nullable();
            $table->date('q2_transfer_date')->nullable();
            $table->string('q2_comment')->nullable();
            $table->date('q2_comment_date')->nullable();
            $table->string('q2_progress_detail')->nullable();
            $table->date('q2_progress_date')->nullable();

            // ข้อ 3
            $table->json('q3_need')->nullable();  
            $table->string('q3_topic')->nullable();
            $table->json('q3_reason')->nullable(); 

            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knowledge_surveys');
    }
};
