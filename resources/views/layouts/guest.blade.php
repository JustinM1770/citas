<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Generador de Citas') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="text-4xl font-bold text-black">
                    Generador de Citas
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white border-2 border-black rounded-lg shadow-sm">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
