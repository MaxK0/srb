<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->dateTime('start');
            $table->dateTime('end');

            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreignId('service_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('status_id')
                ->nullable()
                ->constrained('order_statuses')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('transaction_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->text('information')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
