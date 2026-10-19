<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerserviceComplaintHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerservice_complaint_hds', function (Blueprint $table) {
            $table->id('customerservice_complaint_hds_id');
            $table->boolean('customerservice_complaint_hds_flag')->default(true);
            $table->date('customer_notice_date');
            $table->string('notice_no');
            $table->string('customer_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('evaluation_round')->nullable();
            $table->string('car_no')->nullable();
            $table->date('car_date')->nullable();
            $table->string('recorder')->nullable();
            $table->date('recorded_date')->nullable();
            $table->string('approver')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('factory_action_type')->nullable();
            $table->date('inspection_date')->nullable();
            $table->decimal('cost_material', 18, 2)->default(0);
            $table->decimal('cost_labor', 18, 2)->default(0);
            $table->decimal('cost_transport', 18, 2)->default(0);
            $table->decimal('cost_other', 18, 2)->default(0);
            $table->decimal('cost_total', 18, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->string('factory_reporter')->nullable();
            $table->date('factory_reported_date')->nullable();
            $table->string('factory_approver')->nullable();
            $table->date('factory_approved_date')->nullable();
            $table->string('part3_action_type')->nullable();
            $table->string('part3_factory_signer')->nullable();
            $table->date('part3_completed_date')->nullable();
            $table->date('part3_quotation_date')->nullable();
            $table->date('part3_approved_repair_date')->nullable();
            $table->date('part3_repaired_date')->nullable();
            $table->string('part4_action_type')->nullable();
            $table->string('part4_reporter')->nullable();
            $table->date('part4_reported_date')->nullable();
            $table->string('part4_approver')->nullable();
            $table->date('part4_approved_date')->nullable();
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
        Schema::dropIfExists('customerservice_complaint_hds');
    }
}
