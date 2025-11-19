<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generador de Citas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in {
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
            opacity: 0;
        }

        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-500 { animation-delay: 0.5s; }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full px-6">
        <header class="flex justify-end mb-8 gap-4 animate-fade-in">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn-hover px-6 py-2 border-2 border-black rounded-lg hover:bg-black hover:text-white transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn-hover px-6 py-2 border-2 border-gray-300 rounded-lg hover:border-black transition-colors">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-hover px-6 py-2 border-2 border-black rounded-lg hover:bg-black hover:text-white transition-colors">Registrarse</a>
                    @endif
                @endauth
            @endif
        </header>

        <main class="text-center">
            <h1 class="text-6xl font-light mb-6 animate-fade-in-up delay-100">Generador de Citas</h1>
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto animate-fade-in-up delay-200">Sistema profesional de gestión de citas con roles administrativos y seguimiento completo</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16">
                <div class="card-hover p-8 border-2 border-black rounded-lg animate-fade-in-up delay-300">
                    <h3 class="text-2xl font-light mb-4">Administrador</h3>
                    <p class="text-gray-600">Control total del sistema, profesionales y servicios</p>
                </div>
                
                <div class="card-hover p-8 border-2 border-black rounded-lg animate-fade-in-up delay-400">
                    <h3 class="text-2xl font-light mb-4">Profesional</h3>
                    <p class="text-gray-600">Gestión de horarios y citas personalizadas</p>
                </div>
                
                <div class="card-hover p-8 border-2 border-black rounded-lg animate-fade-in-up delay-500">
                    <h3 class="text-2xl font-light mb-4">Cliente</h3>
                    <p class="text-gray-600">Reserva y seguimiento de tus citas</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>