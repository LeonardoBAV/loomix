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
        Schema::create('fabric_shapes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fabric_id')->constrained()->onDelete('cascade');
            $table->foreignId('shape_id')->constrained()->onDelete('cascade');
            $table->integer('usage');
            $table->decimal('cost', 10, 4);
            $table->string('image')->nullable();
            $table->boolean('sample')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabric_shapes');
    }
};
