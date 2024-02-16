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
        Schema::create('line_item', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("amount");
            $table->unsignedBigInteger("total_price");
            $table->unsignedBigInteger("item_id");
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade');
            $table->unsignedBigInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sale')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('line_item');
    }
};
