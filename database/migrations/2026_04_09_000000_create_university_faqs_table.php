<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('university_faqs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('university_id');
            $table->text('question')->nullable();
            $table->text('answer')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('university_faqs');
    }
};
