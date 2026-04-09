<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('placement_recruiter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('placement_id');
            $table->unsignedBigInteger('recruiter_id');
            $table->timestamps();
            $table->unique(['placement_id', 'recruiter_id']);
            $table->foreign('placement_id')->references('id')->on('placements')->onDelete('cascade');
            $table->foreign('recruiter_id')->references('id')->on('recruiters')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('placement_recruiter');
    }
};
