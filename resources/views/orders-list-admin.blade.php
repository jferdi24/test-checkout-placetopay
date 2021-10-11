@extends('layouts.app',[
    'title' => 'Listado de ordenes',
])
@section('content')
    <div class="bg-gray-100">
        <div class="container bg-white min-h-screen m-auto py-10 px-10">
            <h1 class="font-extrabold mb-5 text-2xl text-gray-900 tracking-tight">{{ __('Listado de ordenes') }}</h1>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg overflow-x-auto">
                <x-table-order :orders="$orders" :show-customer="true" />
            </div>
        </div>
    </div>
@endsection
