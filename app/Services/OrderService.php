<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

abstract class OrderService
{
    public static function createOrderItem(int $orderId, int $productId, int $quantity, float $total): OrderItem
    {
        return OrderItem::create([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'total' => $total,
        ]);
    }

    public static function createOrder(int $customerId, float $total, string $code): Order
    {
        return Order::create([
            'customer_id' => $customerId,
            'total' => $total,
            'code' => $code,
        ]);
    }
}
