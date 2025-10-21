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
        Schema::dropIfExists('lining_product');
        Schema::dropIfExists('linings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('linings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('price', 10, 4);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('lining_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('lining_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity', 10, 3);
            $table->decimal('total', 10, 4);
            $table->timestamps();
        });
    }
};
