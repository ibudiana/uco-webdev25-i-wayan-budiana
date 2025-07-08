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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'waiting_for_confirmation', 'completed', 'failed'])->default('pending');
            $table->text('description')->nullable();
            $table->foreignId('shipping_address_id')->nullable()->constrained('shipping_addresses')->onDelete('set null');
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('payment_proof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
