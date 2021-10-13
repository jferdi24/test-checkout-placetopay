<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_register_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('customers.register'));

        $response
            ->assertSee('Confirmar datos para la orden')
            ->assertSee($product->name)
            ->assertSee($product->price)
            ->assertStatus(200);
    }

    public function test_store_data()
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
}
