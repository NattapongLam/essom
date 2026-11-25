<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualgroupMasterHdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individualgroup_master_hds', function (Blueprint $table) {
            $table->id('individualgroup_master_hds_id');
            $table->boolean('individualgroup_master_hds_flag')->default(true);
            $table->string('product_code');
            $table->string('person_at');
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
        Schema::dropIfExists('individualgroup_master_hds');
    }
}
