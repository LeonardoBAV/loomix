<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Order;
use App\Services\OrderService;
use Exception;

class OrderObserver
{
    public function __construct(private OrderService $orderService) {}

    public function deleting(Order $order): void
    {
        if ($this->orderService->canNotBeDeleted($order)) {
            throw new Exception(__('exceptions.order.cannot_be_deleted'));
        }
    }
}
