<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function resume(string $code): View
    {
        /** @var User $user */
        $user = auth()->user();

        /** @var Order $order */
        $order = Order::query()
            ->where('code', $code)
            ->where('customer_id', $user->id)
            ->with('items')
            ->firstOrFail();

        return view('resume', [
            'order' => $order,
        ]);
    }

    public function adminListOrders(): View
    {
        return view('orders-list-admin', [
            'orders' => Order::query()->get(),
        ]);
    }

    public function listOrders(): View
    {
        /** @var User $user */
        $user = auth()->user();

        return view('orders-list', [
            'orders' => Order::query()->where('customer_id', $user->id)->get(),
        ]);
    }
}
