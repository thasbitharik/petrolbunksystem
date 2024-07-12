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
        Schema::create('pumb_product_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_type_id')->unsigned()->index()->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            $table->bigInteger('pumb_id')->unsigned()->index()->nullable();
            $table->foreign('pumb_id')->references('id')->on('petrol_pumbs')->onDelete('cascade');
            $table->decimal('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pumb_product_types');
    }
};
