<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $productId = $request->product ?? 1;
        $product = Product::find($productId);

        $user = $request->user() ?? new User();

        return view('register-data', [
            'product' => $product,
            'user' => $user,
        ]);
    }

    public function storeData(Request $request)
    {
        $user = null;
        if ($request->user() == null) {
            $user = $this->createCustomer($request);
        } else {
            $user = $this->updateDataCustomer($request);
        }

        $code = $this->createOrder($request, $user);

        return response()->redirectToRoute('orders.resume', $code);
    }

    protected function createCustomer(Request $request)
    {
        $user = User::updateOrcreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'password' => bcrypt(Str::uuid())
            ]
        );

        auth()->login($user);

        return $user;
    }

    protected function updateDataCustomer(Request $request)
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->update();

        return $user;
    }

    protected function createOrder(Request $request, $user)
    {
        $product = Product::find($request->product_id);

        $quantity = $request->quantity;
        $total = $product->price * $quantity;
        $customerId = $user->id;
        $code = time() . Str::random(12);

        $order = OrderService::createOrder($customerId, $total, $code);
        OrderService::createOrderItem($order->id, $product->id, $quantity, $total);

        return $code;
    }
}
