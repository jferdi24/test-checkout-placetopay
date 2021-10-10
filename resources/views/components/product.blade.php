<article class="group relative">
    <div class="w-full bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75">
        <img src="{{ $product->photo }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover lg:w-full lg:h-full">
    </div>
    <div class="py-1 px-3">
        <h3 class="mt-4 text-sm text-gray-700"> {{ $product->name }}</h3>
        <p class="mt-1 text-lg font-medium text-gray-900">${{ $product->price }} USD</p>
        <a href="{{ route('customers.register') }}?product={{ $product->id }}" class="mt-2 bg-blue-900 block hover:bg-blue-600 px-2 py-2 rounded text-center text-white">
            <span>Comprar</span>
        </a>
    </div>
</article>
