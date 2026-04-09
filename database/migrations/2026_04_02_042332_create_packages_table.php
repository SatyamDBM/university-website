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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->decimal('price', 10, 2)->default(0);

            $table->integer('duration')->default(1);
            $table->enum('duration_type', ['days', 'months', 'years'])->default('months');

            $table->enum('coverage_type', [
                'city_level',
                'state_level',
                'multi_city',
                'national'
            ])->default('city_level');

            $table->enum('status', ['active', 'inactive'])->default('active');

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
        Schema::dropIfExists('packages');
    }
};