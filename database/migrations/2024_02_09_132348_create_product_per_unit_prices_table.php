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
        Schema::create('product_per_unit_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_type_id')->unsigned()->index()->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->bigInteger('unit_id')->unsigned()->index()->nullable();
            $table->foreign('unit_id')->references('id')->on('product_purchases')->onDelete('cascade');
            $table->bigInteger('purchase_amount_id')->unsigned()->index()->nullable();
            $table->foreign('purchase_amount_id')->references('id')->on('product_purchases')->onDelete('cascade');
            $table->string('price_for_unit');
            $table->string('mrp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_per_unit_prices');
    }
};
