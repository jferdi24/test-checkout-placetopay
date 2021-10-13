<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_home()
    {
        $response = $this->get(route('home'));

        $response
            ->assertStatus(200)
            ->assertSee('Productos');
    }

    public function test_home_with_products()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('home'));

        $response
            ->assertStatus(200)
            ->assertSee($product->name)
            ->assertSee($product->price)
            ->assertSee($product->photo);
    }
}
