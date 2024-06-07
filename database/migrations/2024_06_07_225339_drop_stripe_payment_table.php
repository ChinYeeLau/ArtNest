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
        Schema::dropIfExists('stripe_payment');    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('stripe_payment', function (Blueprint $table) {
            // Define the table schema if you want to revert the drop operation
            $table->id();
            $table->integer('order_id');
            $table->integer('user_id');
            $table->string('charge_id');
            $table->string('payer_email');
            $table->float('amount');
            $table->string('currency');
            $table->string('payment_status');
            $table->timestamps();
        });
    }
};
