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
        Schema::create('university_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')->constrained()->cascadeOnDelete();

            // Overview
            $table->text('description')->nullable();
            $table->text('history')->nullable();
            $table->text('vision_mission')->nullable();
            $table->year('established_year')->nullable();
            $table->string('university_type')->nullable(); // Govt / Private

            // Accreditation & Ranking
            $table->string('naac_grade')->nullable();
            $table->boolean('ugc_approved')->default(false);
            $table->boolean('aicte_approved')->default(false);
            $table->integer('nirf_ranking')->nullable();
            $table->integer('qs_ranking')->nullable();

            // Workflow
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])
                ->default('draft');

            $table->boolean('is_live')->default(false);

            $table->longText('rejection_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_profiles');
    }
};
