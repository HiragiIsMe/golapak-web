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
            $table->string('transaction_code', 10)->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pelanggan_offline')->nullable();
            $table->integer('total_qty');
            $table->integer('total_main_cost');
            $table->integer('delivery_fee');
            $table->integer('grand_total');
            $table->enum('status', ['pending', 'cooking', 'on_delivery', 'done', 'canceled', 'canceled_done']);
            $table->enum('order_type', ['dine_in', 'take_Away', 'deliver']);
            $table->enum('payment_method', ['cod', 'transfer', 'cash'])->nullable();
            $table->string('account_number')->nullable();
            $table->dateTime('date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
