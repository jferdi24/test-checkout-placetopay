<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;

abstract class OrderService
{
    public static function createOrderItem($orderId, $productId, $quantity, $total)
    {
        return OrderItem::create([
            'order_id' => $orderId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'total' => $total,
        ]);
    }

    public static function createOrder($customerId, float $total, $code)
    {
        return Order::create([
            'customer_id' => $customerId,
            'total' => $total,
            'code' => $code,
        ]);
    }
}
