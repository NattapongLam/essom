<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsoEmailRegistrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iso_email_registration', function (Blueprint $table) {
    $table->id('id'); 
    $table->string('item')->nullable();
    $table->string('email_account')->nullable();
    $table->string('password')->nullable(); 
    $table->string('user_name')->nullable();
    $table->string('position')->nullable();
    $table->string('department')->nullable();
    $table->string('approved_by')->nullable();
    $table->date('date')->nullable();
    $table->text('remark')->nullable();
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
        Schema::dropIfExists('iso_email_registration');
    }
}
