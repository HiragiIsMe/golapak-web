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
            $table->string('trabsaction_code', 10)->unique();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_qty');
            $table->integer('total_main_cost');
            $table->integer('total_selling_cost');
            $table->integer('delivery_fee');
            $table->integer('grand_total');
            $table->enum('status', ['pending', 'cooking', 'on_delivery', 'done']);
            $table->enum('order_type', ['on_spot', 'deliver']);
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
