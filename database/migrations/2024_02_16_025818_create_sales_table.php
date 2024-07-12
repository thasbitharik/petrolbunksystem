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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_name')->unsigned()->index()->nullable();
            $table->foreign('product_name')->references('id')->on('pumb_product_types')->onDelete('cascade');
            $table->bigInteger('pump_name')->unsigned()->index()->nullable();
            $table->foreign('pump_name')->references('id')->on('pumb_product_types')->onDelete('cascade');

            $table->bigInteger('available_unit')->unsigned()->index()->nullable();
            $table->foreign('available_unit')->references('id')->on('product_purchases')->onDelete('cascade');

            $table->bigInteger('unit_per_amount')->unsigned()->index()->nullable();
            $table->foreign('unit_per_amount')->references('id')->on('product_per_unit_prices')->onDelete('cascade');

            $table->string('sales_unit')->nullable();
            $table->string('sales_amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
