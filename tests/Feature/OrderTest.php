<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_pre_order_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('customers.register'));

        $response
            ->assertSee('Confirmar datos para la orden')
            ->assertSee($product->name)
            ->assertSee($product->price)
            ->assertStatus(200);
    }

    public function test_create_user_with_order()
    {
        $product = Product::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->e164PhoneNumber(),

            'product_id' => $product->id,
            'quantity' => 2,
        ];

        $response = $this->post(route('customers.register'), $data);

        $order = Order::find(1);

        $response->assertRedirect(route('orders.resume', $order->code));

        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ]);

        $this->assertDatabaseHas('orders', [
            'customer_id' => 1,
            'total' => $product->price * $data['quantity'],
        ]);

        $this->assertDatabaseHas('orders_items', [
            'product_id' => 1,
            'total' => $product->price * $data['quantity'],
        ]);
    }

    public function test_order_resume_view()
    {
        $product = Product::factory()->create();
        $user = User::factory()->create();

        $quantity = 2;
        $total = $product->price * $quantity;

        $order = Order::factory()->create([
            'total' => $total,
            'customer_id' => $user,
        ]);

        $item = OrderItem::create([
            'total' => $total,
            'product_id' => $product->id,
            'order_id' => $order->id,
            'quantity' => $quantity,
        ]);

        auth()->login($user);

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
}
