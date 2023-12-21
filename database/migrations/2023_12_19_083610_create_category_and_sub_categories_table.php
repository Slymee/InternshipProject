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
        Schema::create('category_and_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
        });

        Schema::table('category_and_sub_categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('category_and_sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_and_sub_categories');
    }
};
