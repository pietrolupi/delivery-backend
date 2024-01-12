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
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->tinyInteger('product_quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->OnDelete();
            $table->foreign('product_id')->references('id')->on('products')->OnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
