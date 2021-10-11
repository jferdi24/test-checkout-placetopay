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
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
            Estado
        </th>
        <th scope="col"
            class="px-6 py-3 text-left text-xs font-medium text-gray-900 uppercase tracking-wider">
            Acciones
        </th>
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($orders as $order)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">{{ $loop->index + 1 }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->created_at }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ $order->code }}</td>
            <td class="px-6 py-4 whitespace-nowrap">$ {{ $order->total }} USD</td>
            <td class="px-6 py-4 whitespace-nowrap">
                {!! $order->statusLabel() !!}
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                @if($order->status != \App\Models\Order::STATUS_PAYED)
                    <a href="{{ route('orders.resume', $order->code) }}"
                       class="bg-green-500 hover:bg-green-900 px-4 py-1 rounded-3xl text-white">
                        Pagar
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
