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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("paid_amount");
            $table->unsignedBigInteger("sale_id");
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->unsignedBigInteger("member_id")->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->boolean('paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
