<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelectionHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selection_hds', function (Blueprint $table) {
            $table->id('product_selection_hd_id');
            $table->boolean('product_selection_hd_flag')->default(true); 
            $table->string('product_type1')->nullable();
            $table->string('product_type2')->nullable();
            $table->string('product_type3')->nullable();
            $table->string('product_type4')->nullable();
            $table->string('requested_by');
            $table->date('requested_date');
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_date')->nullable();
            $table->string('approved_by1')->nullable();
            $table->date('approved_date1')->nullable();
            $table->string('product_selection_hd_remark')->nullable();
            $table->string('assessor_by')->nullable();
            $table->date('assessor_date')->nullable();
            $table->string('approved_by2')->nullable();
            $table->date('approved_date2')->nullable();
            $table->string('product_selection_hd_type')->nullable();
            $table->string('purchase_by')->nullable();
            $table->date('purchase_date')->nullable();
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
        Schema::dropIfExists('product_selection_hds');
    }
}
