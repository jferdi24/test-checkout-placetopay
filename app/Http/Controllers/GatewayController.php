<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderRequestPayment;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GatewayController extends Controller
{
    public function checkoutRequest($code): RedirectResponse|JsonResponse
    {
        /** @var Order $order */
        $order = Order::query()->where('code', $code)->firstOrFail();

        $placetopay = $this->getClient();

        $reference = $code;
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Pagando producto infinito',
                'amount' => [
                    'currency' => 'USD',
                    'total' => $order->total,
                ],
            ],
            'buyer' => [
                'name' => $order->customer->name,
                // "surname" => "Hoppe",
                'email' => $order->customer->email,
                // "document" => "1040035000",
                // "documentType" => "CC",
                'mobile' => $order->customer->mobile,
            ],
            'expiration' => date('c', strtotime(' + 2 days')),
            'returnUrl' => route('checkout.response').'?reference='.$reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];

        try {
            $response = $placetopay->request($request);

            if ($response->isSuccessful()) {
                $this->createRequestPayment($order->id, $response->requestId(), $response->processUrl());

                return response()->redirectTo($response->processUrl());
            }

            return response()->json($response->status()->message());
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function checkoutResponse(Request $request): View|JsonResponse
    {
        $reference = $request->reference;

        /** @var Order $order */
        $order = Order::query()->where('code', $reference)->firstOrFail();

        if (intval($order->customer_id) !== intval($request->user()->id)) {
            abort(403);
        }

        $orderRequestPayment = OrderRequestPayment::query()
            ->where('order_id', $order->id)
            ->where('ending', 0)
            ->latest()
            ->first();

        $placetopay = $this->getClient();

        try {
            $response = $placetopay->query($orderRequestPayment->request_id);

            if ($response->isSuccessful()) {
                if ($response->status()->isApproved()) {
                    $orderRequestPayment->status = $response->status()->status();
                    $orderRequestPayment->ending = 1;

                    $order->status = Order::STATUS_PAYED;
                    $order->update();
                }

                $orderRequestPayment->status = $response->status()->status();
                $orderRequestPayment->response = json_encode($response->toArray());
                $orderRequestPayment->update();

                return view('order-response', [
                    'message' => $response->status()->message(),
                ]);
            }

            return response()->json($response->status()->message()."\n");
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    protected function getClient(): PlacetoPay
    {
        return app('client-placetopay');
    }

    protected function createRequestPayment($orderId, $requestId, $requestUrl): void
    {
        OrderRequestPayment::create([
            'order_id' => $orderId,
            'request_id' => $requestId,
            'process_url' => $requestUrl,
        ]);
    }
}
