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

            $table->enum('slot_name', [
                'homepage_top_banner',
                'homepage_slider_banner',
                'listing_page_banner',
                'search_page_banner',
                'blog_page_banner',
            ]);

            $table->enum('placement_location', [
                'homepage',
                'listing_page',
                'search_page',
                'blog_page',
            ]);

            $table->enum('device_type', [
                'desktop',
                'mobile',
                'both',
            ])->default('both');

            $table->integer('image_width')->nullable();
            $table->integer('image_height')->nullable();

            $table->decimal('monthly_price', 10, 2)->default(0);
            $table->decimal('yearly_price', 10, 2)->default(0);

            $table->integer('display_priority')->default(0);

            $table->enum('status', [
                'active',
                'inactive',
            ])->default('active');

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