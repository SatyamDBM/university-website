<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('mobile')->nullable();

            $table->string('course')->nullable();

            $table->text('message')->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            // Relation with university
            $table->foreignId('university_id')
                ->nullable()
                ->constrained('universities')
                ->nullOnDelete();
            $table->string('assigned_by')->nullable()->default(null);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
