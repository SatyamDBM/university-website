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
        Schema::create('admission_cutoffs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('admission_process_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->string('round')->nullable(); // Round 1, Round 2 etc.
            $table->year('year')->nullable();    // 2024, 2025, 2026
            $table->string('exam')->nullable();  // JEE, NEET etc.

            $table->integer('cutoff')->nullable(); // 85, 90 etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_cutoffs');
    }
};
