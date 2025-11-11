<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function canNotBeDeleted(Order $order): bool
    {
        return $order->productions()->whereNotNull('date_cutting')->exists();
    }

    public function canBeDeleted(Order $order): bool
    {
        return ! $this->canNotBeDeleted($order);
    }
}
