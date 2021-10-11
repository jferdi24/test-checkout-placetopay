@extends('layouts.app',[
    'title' => 'Resultado de la transacción',
])
@section('content')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h1 class="font-extrabold mb-5 text-2xl text-center text-gray-900 tracking-tight">{{ __('Resultado') }}</h1>
                <div class="mb-4">
                    <p>{{ $message }}</p>
                </div>
                <hr>
                <div>
                    <a href="{{ route('orders.list') }}" type="submit" class="mt-2 bg-blue-900 block hover:bg-blue-600 px-2 py-2 rounded text-center text-white w-full">
                        <span>Ir a mis ordenes</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
