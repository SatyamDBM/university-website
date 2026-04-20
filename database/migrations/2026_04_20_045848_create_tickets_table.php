<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('university_id');

            $table->string('subject');
            $table->text('message');

            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            $table->enum('status', ['open', 'replied', 'closed'])->default('open');

            $table->text('admin_reply')->nullable();

            $table->unsignedBigInteger('replied_by')->nullable();

            $table->timestamp('replied_at')->nullable();

            $table->string('attachment')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};