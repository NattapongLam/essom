<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->string('machine_name');          
            $table->json('status')->nullable();      
            $table->string('inspector')->nullable(); 
            $table->date('inspection_date')->nullable(); 
            $table->timestamps();                    
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
