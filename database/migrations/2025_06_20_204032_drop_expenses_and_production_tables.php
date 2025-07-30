<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('expense_items');
        Schema::dropIfExists('expenses');
        Schema::dropIfExists('production_items');
        Schema::dropIfExists('productions');
    }

    public function down(): void
    {
        //just create table with id
        Schema::create('expense_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('production_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('production', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

    }
}; 