<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Laravel' }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="flex-none relative px-10 text-sm leading-6 font-medium ring-1 ring-gray-900 ring-opacity-5 py-5 bg-white text-right">
    <a href="{{ route('home') }}" class="px-5 text-sm text-gray-700 hover:underline hover:text-blue-700">Inicio</a>
    @auth
        <a href="{{ route('orders.list')  }}" class="text-sm text-gray-700 hover:underline hover:text-blue-700">Mis ordenes</a>
    @endauth

</div>

@yield('content')
</body>
</html>
