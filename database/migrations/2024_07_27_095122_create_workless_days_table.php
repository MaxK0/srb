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
        Schema::create('workless_days', function (Blueprint $table) {
            $table->id();

            $table->date('start');
            $table->date('end');

            $table->foreignId('status_id')
                ->nullable()
                ->constrained('workless_statuses')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('workday_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workless_days');
    }
};
