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
        Schema::create('university_linking_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->foreignId('university_id')->nullable()->constrained()->nullOnDelete();

            $table->string('requested_university_name')->nullable();

            $table->string('document_path')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'correction_required'
            ])->default('pending');

            $table->text('remarks')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_linking_requests');
    }
};
