<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_analyses', function (Blueprint $table) {
            $table->id();
            $table->string('product')->unique();
            $table->unsignedInteger('popularity')->default(0);
            $table->decimal('profitability', 10, 2)->default(0);
            $table->string('category')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_analyses');
    }
};
