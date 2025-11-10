<?php

declare(strict_types=1);

use App\Models\Order;
use App\Models\Production;
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
        // bvefore create orders for productions that already exist and put the respective client id
        $productions = Production::all();
        foreach ($productions as $production) {

            $order = Order::create(['client_id' => $production->client_id]);

            $production->update(['order_id' => $order->id]);

        }

        Schema::table('productions', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');

            $table->foreignId('order_id')->nullable(false)->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productions', function (Blueprint $table) {
            $table->foreignId('client_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('order_id')->nullable()->change();
        });
    }
};
