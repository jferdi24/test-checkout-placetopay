@extends('layouts.app',[
    'title' => 'Confirmar datos para la orden',
])
@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="font-extrabold mb-5 text-2xl text-center text-gray-900 tracking-tight">{{ __('Confirmar datos para la orden') }}</h1>
            <form method="POST" action="{{ route('customers.store.data') }}">
                <input type="hidden" value="{{ $product->id }}" name="product_id">
            @csrf
                <div class="mb-4">
                    <label for="name">Nombre</label>
                    <input id="name" class="form-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="name" required autofocus value="{{ $user->name }}">
                </div>
                <div class="mb-4">
                    <label for="email">Email</label>
                    <input id="email" class="form-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="email" name="email" required autofocus value="{{ $user->email }}">
                </div>
                <div class="mb-4">
                    <label for="phone">Celular</label>
                    <input id="phone" class="form-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" type="text" name="mobile" required autofocus value="{{ $user->mobile }}">
                </div>
                <hr>
                <div class="mb-4">
                    <article class="flex py-4 space-x-4">
                        <figure class="flex-none h-18 h-auto object-contain rounded-lg w-18">
                            <img src="{{ $product->photo }} " alt="" class="" width="80" height="80">
                        </figure>
                        <div class="flex-auto min-w-0 relative">
                            <h2 class="text-lg font-semibold text-black mb-0.5">{{ $product->name }}</h2>
                            <h3 class="font-semibold text-black mb-0.5">${{ $product->price }} USD</h3>
                            <div>
                                <label for="">Cantidad:</label>
                                <input type="number" class="form-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" name="quantity" required value="1">
                            </div>
                        </div>
                    </article>
                </div>
                <hr>
                <div>
                    <button type="submit" class="mt-2 bg-blue-900 block hover:bg-blue-600 px-2 py-2 rounded text-center text-white w-full">
                        <span>Crear orden</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
