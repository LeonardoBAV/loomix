<?php

declare(strict_types=1);

use App\Models\Order;
use App\Services\OrderService;

describe('Model Order: canDelete', function () {

    beforeEach(function () {
        $this->orderService = new OrderService;
        $this->order = Order::factory()->create(['id' => 1]);
    });

    it('check the correct validation', function (array $productions, bool $expected) {
        // arrange
        $productions = createProductions($productions);

        // act
        $result = $this->orderService->canBeDeleted($this->order);

        // assert
        expect($result)->toBe($expected);
    })->with('scenarios');

    dataset('scenarios', [
        'no productions' => [
            'productions' => [],
            'expected' => true,
        ],
        'productions but all in pending status' => [
            'productions' => [['id' => 1, 'date_cutting' => null], ['id' => 2, 'date_cutting' => null]],
            'expected' => true,
        ],
        'productions but one with cutting date set' => [
            'productions' => [['order_id' => 1, 'date_cutting' => null], ['order_id' => 1, 'date_cutting' => now()]],
            'expected' => false,
        ],
    ]);

});
