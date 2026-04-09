<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('placements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->string('academic_year');
            $table->decimal('highest_package', 10, 2);
            $table->decimal('average_package', 10, 2);
            $table->decimal('median_package', 10, 2)->nullable();
            $table->decimal('placement_rate', 5, 2);
            $table->integer('total_students_placed')->nullable();
            $table->integer('total_students_eligible')->nullable();
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->timestamps();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('placements');
    }
};
