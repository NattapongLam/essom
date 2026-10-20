<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyLimitedDtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_limited_dts', function (Blueprint $table) {
            $table->id('company_limited_dts_id');
            $table->unsignedBigInteger('company_limited_hds_id');
            $table->foreign('company_limited_hds_id')->references('company_limited_hds_id')->on('company_limited_hds')->onDelete('cascade');
            $table->string('product_code')->nullable();
            $table->string('product_desc')->nullable();
            $table->decimal('min_fin', 18, 2)->default(0);
            $table->decimal('min_semi', 18, 2)->default(0);
            $table->decimal('pdo', 18, 2)->default(0);
            $table->decimal('cur_fin', 18, 2)->default(0);
            $table->decimal('cur_semi', 18, 2)->default(0);
            $table->decimal('ord', 18, 2)->default(0);
            $table->decimal('pto', 18, 2)->default(0);
            $table->decimal('pp', 18, 2)->default(0);
            $table->decimal('jun', 18, 2)->default(0);
            $table->decimal('feb', 18, 2)->default(0);
            $table->decimal('mar', 18, 2)->default(0);
            $table->string('apr_jun')->nullable();
            $table->string('person_at');
            $table->boolean('company_limited_dts_flag')->default(true);
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
        Schema::dropIfExists('company_limited_dts');
    }
}
