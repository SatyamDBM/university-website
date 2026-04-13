<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('university_overviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->text('about')->nullable();
            $table->text('why_choose')->nullable();
            $table->string('established_date', 32)->nullable();
            $table->string('university_type', 100)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('chancellor', 255)->nullable();
            $table->string('campus_area', 100)->nullable();
            $table->integer('total_students')->nullable();
            $table->string('faculty', 255)->nullable();
            $table->string('exams', 255)->nullable();
            $table->string('application_fee', 50)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('naac_score', 50)->nullable();
            $table->json('accreditations')->nullable();
            $table->string('brochure')->nullable();

            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('university_overviews');
    }
};
