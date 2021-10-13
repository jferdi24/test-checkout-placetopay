<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_resume_view_guest()
    {
        $this
            ->get(route('orders.resume', 1))
            ->assertRedirect(route('home'))
            ->assertStatus(302);
    }

    public function test_order_resume_view()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create()->first();

        $quantity = 2;
        $total = $product->price * $quantity;

        $order = Order::factory()->create([
            'total' => $total,
            'customer_id' => $user,
        ]);

        OrderItem::create([
            'total' => $total,
            'product_id' => $product->id,
            'order_id' => $order->id,
            'quantity' => $quantity,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orders.resume', $order->code))
            ->assertSee('Resumen de la orden')
            ->assertSee($product->name)
            ->assertSee($product->price)
            ->assertSee($order->total)
            ->assertSee("Cantidad: $quantity")
            ->assertStatus(200);
    }

    public function test_order_resume_view_when_code_wrong()
    {
        $user = User::factory()->create()->first();

        $this
            ->actingAs($user)
            ->get(route('orders.resume', 'sd'))
            ->assertSee('404')
            ->assertSee('Not Found')
            ->assertStatus(404);
    }

    public function test_order_resume_view_when_order_not_belongs_user()
    {
        $user = User::factory()->create()->first();

        $order = Order::factory()->create([
            'total' => 100,
            'customer_id' => 2,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orders.resume', $order->code))
            ->assertSee('403')
            ->assertStatus(403);
    }

    public function test_admin_list_orders_view()
    {
        $this
            ->get(route('admin.orders.list'))
            ->assertSee('Listado de ordenes')
            ->assertSee('No hay ordenes')
            ->assertStatus(200);
    }

    public function test_admin_list_orders_view_with_data()
    {
        $user = User::factory()->create()->first();

        $order = Order::factory()->create([
            'customer_id' => $user->id,
        ]);

        $this
            ->get(route('admin.orders.list'))
            ->assertSee('Listado de ordenes')
            ->assertDontSee('No hay ordenes')
            ->assertStatus(200);
    }

    public function test_list_orders_guest()
    {
        $this
            ->get(route('orders.list'))
            ->assertRedirect(route('home'))
            ->assertStatus(302);
    }

    public function test_list_orders_user()
    {
        $user = User::factory()->create()->first();

        $order = Order::factory()->create([
            'customer_id' => $user->id,
        ]);

        $this
            ->actingAs($user)
            ->get(route('orders.list'))
            ->assertSee('Mis ordenes')
            ->assertSee($order->code)
            ->assertSee($order->total)
            ->assertStatus(200);
    }
}
