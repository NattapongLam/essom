<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientSelectionSubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient_selection_subs', function (Blueprint $table) {
            $table->id('recipient_selection_sub_id');
            $table->unsignedBigInteger('recipient_selection_hd_id');
            $table->foreign('recipient_selection_hd_id')->references('recipient_selection_hd_id')->on('recipient_selection_hds')->onDelete('cascade');
            $table->integer('recipient_selection_sub_listno');
            $table->string('recipient_selection_sub_name');
            $table->boolean('recipient_selection_sub_results1')->default(false); 
            $table->boolean('recipient_selection_sub_results2')->default(false); 
            $table->boolean('recipient_selection_sub_results3')->default(false); 
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
        Schema::dropIfExists('recipient_selection_subs');
    }
}
