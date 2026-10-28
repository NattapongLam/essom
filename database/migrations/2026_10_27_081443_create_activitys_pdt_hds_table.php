<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitysPdtHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activitys_pdt_hds', function (Blueprint $table) {
            $table->id('activitys_pdt_hds_id');
            $table->string('docutype')->default('GF113.1-F');
            $table->string('time_no')->nullable();
            $table->string('department')->nullable();
            $table->date('audit_date')->nullable();
            $table->string('employee_name')->nullable();
            $table->text('strengths')->nullable();
            $table->text('improvements')->nullable();
            $table->integer('total_score')->default(0);
            $table->string('prepared_by')->nullable();
            $table->date('prepared_date')->nullable();
            $table->string('checked_by')->nullable();
            $table->date('checked_date')->nullable();
            $table->boolean('activitys_pdt_hds_flag')->default(true);
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
        Schema::dropIfExists('activitys_pdt_hds');
    }
}
