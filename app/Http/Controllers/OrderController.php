<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function resume(Request $request, $code)
    {
        $order = Order::where('code', $code)->with('items')->first();

        if($order->customer_id !== $request->user()->id){
            abort(403);
        }

        return view('resume', [
            'order' => $order,
        ]);
    }

    public function adminListOrders()
    {
        return view('orders-list-admin', [
            'orders' => Order::get(),
        ]);
    }

    public function listOrders(Request $request)
    {
        return view('orders-list', [
            'orders' => Order::where('customer_id', $request->user()->id)->get(),
        ]);
    }
}
