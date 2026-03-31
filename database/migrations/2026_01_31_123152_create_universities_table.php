<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('name');
            $table->string('slug')->unique()->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();

            $table->string('country');
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            // Relation with users
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete(); // better than cascade for nullable FK

            // Admin control
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
