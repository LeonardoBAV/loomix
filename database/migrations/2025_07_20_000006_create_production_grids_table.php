<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_grids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained()->cascadeOnDelete();
            $table->foreignId('size_id')->constrained()->restrictOnDelete();
            $table->integer('qty');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_grids');
    }
};
