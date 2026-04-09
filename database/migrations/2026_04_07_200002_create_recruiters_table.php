<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('recruiters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->string('company_name');
            $table->string('logo')->nullable();
            $table->string('industry_type')->nullable();
            $table->timestamps();
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('recruiters');
    }
};
