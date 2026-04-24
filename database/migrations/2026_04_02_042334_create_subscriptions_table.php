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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')->constrained()->cascadeOnDelete();
            $table->foreignId('package_id')->constrained()->cascadeOnDelete();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->integer('total_days')->default(0);
            $table->integer('remaining_days')->default(0);

            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2)->default(0);

            $table->string('payment_status')->default('pending');
            $table->string('transaction_id')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('razorpay_signature')->nullable();

            $table->boolean('auto_renew')->default(false);
            $table->date('renewal_date')->nullable();

            $table->integer('featured_used')->default(0);
            $table->integer('banner_used')->default(0);
            $table->integer('lead_used')->default(0);
            $table->integer('course_used')->default(0);
            $table->integer('city_used')->default(0);
            $table->integer('state_used')->default(0);

            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
