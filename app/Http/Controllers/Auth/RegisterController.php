<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function register(Request $request): View
    {
        $productId = $request->product ?? 1;
        $product = Product::query()->find($productId);

        $user = $request->user() ?? new User();

        return view('register-data', [
            'product' => $product,
            'user' => $user,
        ]);
    }

    public function storeData(Request $request): RedirectResponse
    {
        $user = $this->getUser($request);
        $code = $this->createOrder($request, $user);

        return response()->redirectToRoute('orders.resume', $code);
    }

    private function getUser(Request $request): User
    {
        if ($request->user() === null) {
            return $this->createCustomer($request);
        }

        return $this->updateDataCustomer($request);
    }

    protected function createCustomer(Request $request): User
    {
        $user = User::updateOrcreate(
            [
                'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'password' => bcrypt(Str::uuid()),
            ]
        );

        auth()->login($user);

        return $user;
    }

    protected function updateDataCustomer(Request $request): User
    {
        $user = $request->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;

        $user->update();

        return $user;
    }

    protected function createOrder(Request $request, $user): string
    {
        /** @var Product $product */
        $product = Product::query()->find($request->product_id);

        $quantity = $request->quantity;
        $total = $product->price * $quantity;
        $customerId = $user->id;
        $code = time().Str::random(12);

        $order = OrderService::createOrder($customerId, $total, $code);
        OrderService::createOrderItem($order->id, $product->id, $quantity, $total);

        return $code;
    }
}
