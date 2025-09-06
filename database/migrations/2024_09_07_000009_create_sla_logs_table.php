<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sla_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->string('endpoint');
            $table->integer('response_time_ms');
            $table->unsignedSmallInteger('status_code');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sla_logs');
    }
};
