<span
    class="hidden px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 bg-green-100 text-green-800 bg-blue-100 text-blue-800"></span>
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">#
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Id
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Fecha
            creación
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Code
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">Total
        </th>
        @if($showCustomer)
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Cliente
            </th>
        @endif
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
            Estado
        </th>
        @if(!$showCustomer)
            <th scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
                Acciones
            </th>
        @endif
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @forelse($orders as $order)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->index + 1 }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->code }}</td>
            <td class="px-6 py-4 whitespace-nowrap">$ {{ $order->total }} USD</td>
            @if($showCustomer)
                <td class="px-6 py-4 whitespace-nowrap">
                    <p>{{ $order->customer->name }}</p>
                    <p>{{ $order->customer->email }}</p>
                    <p>{{ $order->customer->mobile }}</p>
                </td>
            @endif
            <td class="px-6 py-4 whitespace-nowrap">
                {!! $order->statusLabel() !!}
            </td>
            @if(!$showCustomer)
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($order->status != \App\Models\Order::STATUS_PAYED)
                        <a href="{{ route('orders.resume', $order->code) }}"
                           class="bg-green-500 hover:bg-green-900 px-4 py-1 rounded-3xl text-white">
                            Pagar
                        </a>
                    @endif
                </td>
            @endif
        </tr>
    @empty
        <tr>
            <td colspan="7">No hay ordenes</td>
        </tr>
    @endforelse
    </tbody>
</table>
