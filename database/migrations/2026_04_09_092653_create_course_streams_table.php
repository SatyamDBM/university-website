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
        Schema::create('course_streams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();

            $table->string('name'); // CSE, IT, Mechanical

            // Academic
            $table->string('duration')->nullable();
            $table->string('intake')->nullable();
            $table->longText('description')->nullable();
            $table->enum('mode', ['Full-time', 'Part-time', 'Online'])->nullable();
            // Fees
            $table->decimal('min_fee', 12, 2)->nullable();
            $table->decimal('max_fee', 12, 2)->nullable();

            // Eligibility
            $table->string('min_qualification')->nullable();
            $table->string('min_percentage')->nullable();
            $table->string('entrance_exams')->nullable();

            // Extra
            $table->integer('seats')->nullable();
            $table->decimal('avg_package', 12, 2)->nullable();
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_streams');
    }
};
