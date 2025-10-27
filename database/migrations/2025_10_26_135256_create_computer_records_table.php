<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_records', function (Blueprint $table) {
            $table->id();
            $table->string('asset_number');
            $table->string('user_name');
            $table->string('period');
            $table->json('maintenance_status')->nullable();

            $table->json('check_by')->nullable();
            $table->json('date_check')->nullable();
            $table->text('remark')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_records');
    }
};
