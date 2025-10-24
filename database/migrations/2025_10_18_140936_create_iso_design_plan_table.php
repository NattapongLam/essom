<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iso_design_plan', function (Blueprint $table) {
            $table->id();
            
        
            $table->date('design_request_date')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_model')->nullable();
            $table->string('product_description')->nullable();

        
            $table->boolean('reason_cost_price')->default(false);
            $table->boolean('reason_catalog_picture')->default(false);
            $table->boolean('reason_drawing')->default(false);
            $table->boolean('reason_prototype')->default(false);
            $table->string('reason_other')->nullable();

      
            for ($i = 1; $i <= 8; $i++) {
                $table->string("design_input_$i")->nullable();
            }

           
            $table->string('ref_brand1')->nullable();
            $table->string('ref_model1')->nullable();
            $table->string('ref_brand2')->nullable();
            $table->string('ref_model2')->nullable();

         
            $table->string('requested_by')->nullable();
            $table->date('requested_date')->nullable();
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('approved_by_request')->nullable();
            $table->date('approved_date_request')->nullable();
            $table->string('engineer_desing')->nullable();
            $table->string('senior_engineer')->nullable();

        
            $table->date('plan_calc')->nullable();
            $table->date('act_calc')->nullable();
            $table->date('plan_review')->nullable();
            $table->date('act_review')->nullable();
            $table->string('participants')->nullable();
            $table->date('plan_verify')->nullable();
            $table->date('act_verify')->nullable();
            $table->date('plan_proto')->nullable();
            $table->date('act_proto')->nullable();
            $table->date('plan_valid')->nullable();
            $table->date('act_valid')->nullable();
            $table->date('plan_final')->nullable();
            $table->date('act_final')->nullable();

            $table->string('planned_by')->nullable();
            $table->date('planned_date_engineering')->nullable();
            $table->string('planned_marketing')->nullable();
            $table->date('planned_date_marketing')->nullable();
            $table->string('planned_plant')->nullable();
            $table->date('planned_date_plant')->nullable();

            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iso_design_plan');
    }
};
