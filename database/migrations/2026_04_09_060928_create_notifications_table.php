<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('title');
            $table->text('message')->nullable();

            $table->string('type')->nullable();
            // example: lead, course, payment, banner, featured_package

            $table->string('related_type')->nullable();
            // example: enquiry, course, package, banner

            $table->unsignedBigInteger('related_id')->nullable();

            $table->string('action_url')->nullable();

            $table->boolean('is_read')->default(false);

            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};