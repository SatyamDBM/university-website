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
        Schema::create('banner_payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('university_banner_id');

            $table->string('transaction_id')->nullable();
            $table->string('payment_method')->nullable();

            $table->decimal('amount', 10, 2)->default(0);

            $table->enum('payment_status', ['pending', 'success', 'failed'])->default('pending');

            $table->timestamp('paid_at')->nullable();

            $table->timestamps();

            $table->foreign('university_banner_id')
                ->references('id')
                ->on('university_banners')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_payments');
    }
};