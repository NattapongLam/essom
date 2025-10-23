<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('iso_machine_history', function (Blueprint $table) {
            $table->id();
            $table->string('machine_name');         
            $table->string('machine_number');       
            $table->date('date_start');              
            $table->string('department');             
            $table->json('repair_date')->nullable();    
            $table->json('repair_description')->nullable(); 
            $table->json('repair_person')->nullable();      
            $table->text('remarks')->nullable();       
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iso_machine_history');
    }
};
