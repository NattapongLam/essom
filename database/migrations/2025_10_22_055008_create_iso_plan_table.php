<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iso_plan', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('responsible_section');
            $table->json('activities')->nullable();
            $table->string('prepared_by')->nullable();
            $table->date('prepared_date')->nullable();
            $table->string('prepared_progress_review')->nullable();
            $table->date('prepared_progress_date')->nullable();
            $table->string('reported_progress_review')->nullable();
            $table->date('reported_date')->nullable();
            $table->string('reported_by')->nullable();
            $table->date('reported_progress_date')->nullable();
            $table->string('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('acknowledged_by')->nullable();
            $table->date('acknowledged_date')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iso_plan');
    }
};
