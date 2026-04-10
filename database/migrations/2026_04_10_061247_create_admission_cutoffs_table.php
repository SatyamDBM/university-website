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
            $table->foreignId('admission_process_id')->constrained()->cascadeOnDelete();
            $table->string('course');
            $table->string('exam');
            $table->string('cutoff');
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
