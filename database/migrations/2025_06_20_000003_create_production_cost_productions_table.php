<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_cost_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_cost_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->integer('count');
            $table->decimal('cost', 10, 4);
            $table->timestamps();
            
            $table->unique(['production_cost_id', 'product_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_cost_productions');
    }
}; 