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
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('adress_id');
            $table->text('notes');
            $table->dateTime('delivery_date');
            $table->dateTime('arrival_date');
            $table->enum('status', ['pending', 'process', 'arrived']);
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('courier_id')->references('id')->on('couriers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('adress_id')->references('id')->on('addresses')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};
