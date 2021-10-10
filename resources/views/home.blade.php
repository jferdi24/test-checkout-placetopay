@extends('layouts.app',[
    'title' => 'Inicio',
])

@section('content')
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">Productos</h1>

            <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach($products as $product)
                    <x-product :product="$product"/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
