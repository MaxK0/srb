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
        Schema::create('extra_days', function (Blueprint $table) {
            $table->id();

            $table->date('date_start');
            $table->date('date_end');
            
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            
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
        Schema::dropIfExists('extra_days');
    }
};
