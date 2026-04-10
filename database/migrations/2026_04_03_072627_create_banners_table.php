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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('slot_name');

            $table->enum('placement_location', [
                'homepage',
                'search_page',
                'listing_page',
                'course_detail_page',
                'university_detail_page',
                'blog_page',
            ]);

            $table->enum('device_type', [
                'desktop',
                'mobile',
                'tablet',
                'all',
            ])->default('all');

            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            $table->integer('max_banner_limit')->default(1);

            $table->enum('rotation_type', [
                'single_banner',
                'random_rotation',
                'slider_rotation',
            ])->nullable();

            $table->enum('priority', [
                'high',
                'medium',
                'low',
            ])->nullable();


            $table->decimal('price', 10, 2)->default(0);
            $table->integer('duration')->nullable();
            $table->enum('duration_type', ['days','months','years',])->nullable();

            $table->enum('status', [
                'active',
                'inactive',
            ])->default('active');

            $table->text('description')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};