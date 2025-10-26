<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessrisk_swot', function (Blueprint $table) {
            $table->id();
            
            $table->date('meeting_date')->nullable();
            $table->json('strategy')->nullable();       
            

            $table->json('strength')->nullable();      
            $table->json('weakness')->nullable();     
            $table->json('opportunity')->nullable(); 
            $table->json('threat')->nullable();       

            $table->json('review_summary')->nullable(); 

            $table->string('report_by')->nullable();
            $table->date('report_date')->nullable();
            $table->string('ack_by')->nullable();
            $table->date('ack_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessrisk_swot');
    }
};
