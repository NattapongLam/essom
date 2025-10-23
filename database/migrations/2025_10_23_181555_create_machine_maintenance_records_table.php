<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('machine_maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->string('machine');         
            $table->json('items_status');       
            $table->string('checked_by')->nullable();      
            $table->date('checked_date')->nullable();      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machine_maintenance_records');
    }
};
