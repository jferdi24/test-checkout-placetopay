<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('status', 20)->default('CREATED');
            $table->decimal('total');
            $table->string('code');

            $table->timestamps();
        });

        Schema::create('orders_items', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->decimal('total');
        });

        Schema::create('orders_requests_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->string('request_id');
            $table->string('process_url');
            $table->text('response')->nullable();
            $table->boolean('ending')->default(0);
            $table->string('status')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orders_items');
        Schema::dropIfExists('orders_requests_payments');
    }
};
