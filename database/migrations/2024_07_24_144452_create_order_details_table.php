<?php

use App\Models\Orders;
use App\Models\Products;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->foreignIdFor(Orders::class)->constrained();
            $table->foreignIdFor(Products::class)->constrained();
            
            //pivote

            $table->unsignedInteger('qty');
            $table->unsignedBigInteger('price');

            $table->primary(['orders_id', 'products_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
