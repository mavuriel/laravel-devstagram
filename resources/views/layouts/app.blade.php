<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Devstagram | @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles')
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    {{--    @vite(['resources/js/app.js', 'resources/css/app.css', 'node_modules/dropzone/dist/dropzone.css'])--}}
    @livewireStyles
</head>
<body class="antialiased">
<header class="p-5 border-b bg-white shadow">
    <div class="container mx-auto flex justify-between items-center">
        <a class="text-3xl font-black" href='{{route('home')}}'>Devstagram</a>
        <nav class="flex gap-4 items-center">

            {{-- @if(auth()->user()) autenticado @else no autenticado @endif --}}

            @auth()
                <a
                    href="{{ route('post.create') }}"
                    class="flex items-center gap-1 border border-gray-500 rounded p-2 bg-white text-gray-600 text-sm uppercase font-bold cursor-pointer"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="px-0.5">Crear</span>
                </a>

                <a
                    href='{{route('post.index', auth()->user()->username)}}'
                    class='font-bold uppercase text-gray-600 text-sm'
                >
                    {{auth()->user()->username}}
                </a>

                <form action='{{route('logout')}}' method='POST'>
                    @csrf
                    <button class='font-bold uppercase text-gray-600 text-sm'>
                        Cerrar sesión
                    </button>
                </form>
            @endauth

            @guest()
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Iniciar sesión</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('signup.index') }}">Crear cuenta</a>
            @endguest


        </nav>
    </div>
</header>
<main class="container mx-auto mt-10">
    <h2 class="font-black text-center text-3xl mb-10">@yield('title')</h2>
    @yield('content')
</main>
<footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
    Devstagram - {{ now()->year }}
</footer>
@livewireScripts
</body>
</html>
