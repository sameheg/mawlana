<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('from_branch');
            $table->string('to_branch');
            $table->integer('quantity');
            $table->string('status')->default('pending');
            $table->text('delivery_log')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_transfers');
    }
};
