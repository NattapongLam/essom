<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductListSelectedHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_list_selected_hds', function (Blueprint $table) {
            $table->id('product_list_selected_hd_id');
            $table->string('product_list_selected_hd_product');
            $table->string('person_at');
            $table->boolean('product_list_selected_hd_flag')->default(true); 
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
        Schema::dropIfExists('product_list_selected_hds');
    }
}
