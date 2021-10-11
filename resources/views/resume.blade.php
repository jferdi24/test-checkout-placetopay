@extends('layouts.app',[
    'title' => 'Register Data Customer',
])
@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="font-extrabold mb-5 text-2xl text-center text-gray-900 tracking-tight">{{ __('Resumen de la orden') }}</h1>
            <form method="POST" action="{{ route('checkout.request', $order->code) }}">
                <input type="hidden" value="{{ $order->id }}" name="order_id">
                @csrf
                <hr>
                <div class="mb-4">
                    <article class="flex py-4 space-x-4">
                        <figure class="flex-none h-18 h-auto object-contain rounded-lg w-18">
                            <img src="{{ $order->items->first()->product->photo }} " alt="" class="" width="80" height="80">
                        </figure>
                        <div class="flex-auto min-w-0 relative">
                            <h2 class="text-lg font-semibold text-black mb-0.5">{{ $order->items->first()->product->name }}</h2>
                            <h3 class="font-semibold text-black mb-0.5">${{ $order->items->first()->product->price }} USD</h3>
                            <h3>Cantidad: {{ $order->items->first()->quantity }}</h3>
                            <h4>Total: <span class="">${{ $order->total }}</span></h4>
                        </div>
                    </article>
                </div>
                <hr>
                <div>
                    <button type="submit" class="mt-2 bg-blue-900 block hover:bg-blue-600 px-2 py-2 rounded text-center text-white w-full">
                        <span>Pagar con Placetopay</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
