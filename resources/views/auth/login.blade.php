@extends('layouts.app')

@section('title', 'Inicia sesión')

@section('content')
    <div class='md:flex md:gap-10 md:justify-center md:items-center'>
        <div class='md:w-6/12 p-4'>
            <img src="{{ asset('img/login.webp') }}" alt="imagen login">
        </div>
        <div class='md:w-4/12 bg-white p-6 rounded-lg shadow-lg'>
            <form method='POST' action='{{ route('login') }}' novalidate>
                @csrf

                @error('credentials')
                <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">{{$message}}</p>
                @enderror

                <div class='mb-5'>
                    <label for='email' class='mb-2 block uppercase text-gray-500 font-bold'>Correo electrónico</label>
                    <input
                        type="email"
                        id='email'
                        name='email'
                        placeholder='Tu correo electrónico'
                        class='border p-3 mb-2 w-full rounded-lg @error('email') border-red-500 @enderror'
                        value='{{old('email')}}'
                    >
                    @error('email')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                <div class='mb-5'>
                    <label for='password' class='mb-2 block uppercase text-gray-500 font-bold'>Contraseña</label>
                    <input
                        type="password"
                        id='password'
                        name='password'
                        placeholder='Tu contraseña'
                        class='border p-3 mb-2 w-full rounded-lg @error('password') border-red-500 @enderror'
                    >
                    @error('password')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class='mb-5'>
                    <input type="checkbox" name="remember" id='keep-session'>
                    <label
                        for='keep-session'
                        class='text-gray-500 text-sm'
                    >
                        Mantener la sesión abierta
                    </label>
                </div>
                <button
                    type="submit"
                    class='bg-sky-600 hover:bg-sky-700 transitions-colors uppercase font-bold w-full p-3 text-white rounded-lg'
                >
                    Inicia sesión
                </button>
            </form>
        </div>
    </div>
@endsection
