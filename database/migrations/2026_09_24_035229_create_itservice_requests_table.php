<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItserviceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itservice_requests', function (Blueprint $table) {
            $table->id('itservice_requests_id');
            $table->string('objective_status');
            $table->string('objective_remark')->nullable();
            $table->string('itservice_requests_note');
            $table->string('itservice_requests_person');
            $table->string('itservice_requests_department');
            $table->date('itservice_requests_date');
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
        Schema::dropIfExists('itservice_requests');
    }
}
