<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_cost_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_cost_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->decimal('value', 10, 4);
            $table->timestamps();

            $table->unique(['production_cost_id', 'title']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_cost_expenses');
    }
};
