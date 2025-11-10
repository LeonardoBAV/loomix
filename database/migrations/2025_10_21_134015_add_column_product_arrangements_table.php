<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('product_arrangements', function (Blueprint $table) {
            $table->decimal('sale_price', 10, 4)->nullable()->after('default');
        });
    }

    public function down(): void
    {
        Schema::table('product_arrangements', function (Blueprint $table) {
            $table->dropColumn('sale_price');
        });
    }
};
