<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iso_knowledge_registers', function (Blueprint $table) {
            $table->id();
            $table->json('document_code')->nullable();
            $table->json('received_date')->nullable();
            $table->json('doc_title')->nullable();

            $table->timestamps(); // created_at / updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iso_knowledge_registers');
    }
};
