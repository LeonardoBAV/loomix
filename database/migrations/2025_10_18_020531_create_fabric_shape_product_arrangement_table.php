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
        Schema::create('fabric_shape_product_arrangement', function (Blueprint $table) {
            // $table->id();
            $table->foreignId('product_arrangement_id')->constrained()->onDelete('cascade');
            $table->foreignId('fabric_shape_id')->constrained('fabric_shape')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabric_shape_product_arrangement');
    }
};
