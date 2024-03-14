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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id')->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedTinyInteger('quantity');

            $table->unsignedBigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
