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
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table
            ->unsignedBigInteger('restaurant_id');

            $table
            ->foreign('restaurant_id')
            ->references('id')
            ->on('restaurants')
            ->onDelete('cascade');

            $table->string('name');
            $table->string('ingredients');
            $table->text('description', 400)->nullable();
            $table->decimal('price', 6, 2)->unsigned();
            $table->boolean('visibility');
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
