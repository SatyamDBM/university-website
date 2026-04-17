<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();

            // Hero Section
            $table->string('banner_image')->nullable();
            $table->string('small_heading')->nullable();
            $table->string('heading')->nullable();
            $table->text('description')->nullable();

            // Founder Section
            $table->string('founder_section_badge')->nullable();
            $table->string('founder_section_title')->nullable();
            $table->string('founder_image')->nullable();
            $table->string('founder_name')->nullable();
            $table->string('founder_designation')->nullable();
            $table->longText('founder_description')->nullable();
            $table->string('founder_button_text')->nullable();
            $table->string('founder_button_link')->nullable();

            // Journey Section
            $table->string('journey_section_badge')->nullable();
            $table->string('journey_section_title')->nullable();
            $table->longText('journey_description')->nullable();

            // Leadership Section
            $table->string('leadership_section_badge')->nullable();
            $table->string('leadership_section_title')->nullable();
            $table->text('leadership_description')->nullable();

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};