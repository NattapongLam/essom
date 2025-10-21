<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('knowledge_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('department');
            $table->string('position');
            $table->date('request_date');
            $table->string('documentKM_no');
            $table->string('OZN'); 
            $table->string('document_no');
            $table->string('subject');
            $table->text('details')->nullable();
            $table->string('attached_file')->nullable();
            $table->string('approval')->nullable();
            $table->date('transfer_date')->nullable(); 
            $table->string('NameCF')->nullable(); 
            $table->date('approval_date')->nullable(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knowledge_records');
    }
};