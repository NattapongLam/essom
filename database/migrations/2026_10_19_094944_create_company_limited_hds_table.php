<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLimitedHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_limited_hds', function (Blueprint $table) {
            $table->id('company_limited_hds_id');
            $table->boolean('company_limited_hds_flag')->default(true);
            $table->date('for_month');
            $table->date('for_year');
            $table->string('prepared_by');
            $table->date('prepared_date');
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
        Schema::dropIfExists('company_limited_hds');
    }
}
