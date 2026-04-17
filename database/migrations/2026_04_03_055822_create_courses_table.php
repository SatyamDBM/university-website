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
            $table->foreignId('university_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('course_name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('degree_level')->default('Bachelors');

            // Academic Details
            $table->string('duration')->nullable(); // e.g., 3 years / 6 semesters
            $table->enum('course_type', ['Full-time', 'Part-time', 'Online'])->nullable();
            $table->enum('mode', ['Offline', 'Hybrid', 'Online'])->nullable();

            // Fees Structure
            $table->decimal('tuition_fees', 12, 2)->nullable();
            $table->decimal('hostel_fees', 12, 2)->nullable();
            $table->decimal('admission_fees', 12, 2)->nullable();
            $table->decimal('total_fees', 12, 2)->nullable();

            // Eligibility
            $table->string('min_qualification')->nullable();
            $table->string('min_percentage')->nullable();
            $table->string('required_exams')->nullable();
            $table->string('age_limit')->nullable();

            // Curriculum / Syllabus
            $table->string('curriculum_file')->nullable(); // PDF or file path
            $table->longText('curriculum_text')->nullable();

            // Additional Fields
            $table->integer('seat_availability')->nullable();
            $table->enum('admission_status', ['Open', 'Closed'])->default('Open');

            // Status Lifecycle
            $table->enum('status', ['Draft', 'Pending', 'Live', 'Rejected'])->default('Draft');
            $table->text('admin_feedback')->nullable();
            $table->softDeletes();

            $table->timestamps();
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
