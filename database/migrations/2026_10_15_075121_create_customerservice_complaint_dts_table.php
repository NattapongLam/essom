<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerserviceComplaintDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customerservice_complaint_dts', function (Blueprint $table) {
            $table->id('customerservice_complaint_dts_id');
            $table->unsignedBigInteger('customerservice_complaint_hds_id');
            $table->foreign('customerservice_complaint_hds_id')->references('customerservice_complaint_hds_id')->on('customerservice_complaint_hds')->onDelete('cascade');
            $table->integer('listno');
            $table->string('product_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('initial_symptom')->nullable();
            $table->string('cause')->nullable();
            $table->string('solution')->nullable();
            $table->decimal('qty', 18, 2)->default(0);
            $table->decimal('price', 18, 2)->default(0);
            $table->string('table_type')->nullable();
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
        Schema::dropIfExists('customerservice_complaint_dts');
    }
}
