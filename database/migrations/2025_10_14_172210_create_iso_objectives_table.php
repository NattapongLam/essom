<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iso_objectives', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->string('description')->nullable();
            $table->string('resp_person')->nullable();
            $table->string('previous')->nullable();
            $table->string('plan')->nullable();
            $table->string('results')->nullable();
            $table->string('remarks')->nullable();
            $table->string('section')->nullable();
            $table->string('period')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iso_objectives');
    }
};