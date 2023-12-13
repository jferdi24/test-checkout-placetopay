<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GatewayControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_checkout_request()
    {
        $user = User::factory()->create()->first();

        $order = Order::factory()->create([
            'total' => 100,
            'customer_id' => 1,
        ]);

        $this
            ->actingAs($user)
            ->post(route('checkout.request', $order->code))
            ->assertStatus(302);
    }

    public function test_checkout_request_with_order_wrong()
    {
        $user = User::factory()->create()->first();

        Order::factory()->create([
            'total' => 100,
            'customer_id' => 1,
        ]);

        $this
            ->actingAs($user)
            ->post(route('checkout.request', 1))
            ->assertSee('404')
            ->assertSee('Not Found')
            ->assertStatus(404);
    }
}
