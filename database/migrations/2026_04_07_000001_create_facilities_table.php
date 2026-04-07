<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->string('facility_name');
            $table->string('facility_type');
            $table->text('description');
            $table->integer('capacity')->nullable();
            $table->boolean('availability')->default(true);
            $table->enum('gender_specific', ['boys', 'girls', 'both'])->nullable();
            $table->boolean('is_top')->default(false);
            $table->boolean('is_highlight')->default(false);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
