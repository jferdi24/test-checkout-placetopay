<?php

namespace Tests\Unit\Models;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_belongs_to_user()
    {
        $order = Order::factory()->create();

        $this->assertInstanceOf(User::class, $order->customer);
    }

    public function test_has_many_items()
    {
        $order = new Order;

        $this->assertInstanceOf(Collection::class, $order->items);
    }

    public function test_is_string_status_label()
    {
        $order = new Order;

        $this->assertIsString($order->statusLabel());
    }
}
