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
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();

            $table->string('banner_image')->nullable();
            $table->string('small_heading')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();

            // Head Office Section
            $table->string('head_office_title')->nullable();
            $table->text('head_office_address')->nullable();
            $table->string('head_office_phone')->nullable();
            $table->string('head_office_email')->nullable();
            $table->string('head_office_working_hours')->nullable();
            $table->string('head_office_map_iframe')->nullable();

            // Student Support Section
            $table->string('student_support_title')->nullable();
            $table->text('student_support_description')->nullable();
            $table->string('student_support_email')->nullable();
            $table->string('student_support_phone')->nullable();

            // SEO Fields
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_us');
    }
};