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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Nullable FK (important change)
            $table->foreignId('university_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete(); // better than cascade for nullable FK

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            $table->string('degree_type'); // Bachelor, Master
            $table->string('field'); // IT, Business

            $table->integer('duration')->nullable(); // months
            $table->decimal('tuition_fee', 10, 2)->nullable();

            $table->string('currency')->default('USD');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Soft delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
