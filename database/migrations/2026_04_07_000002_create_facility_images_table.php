<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facility_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('facility_id');
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->string('alt_text')->nullable();
            $table->timestamps();
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('facility_images');
    }
};
