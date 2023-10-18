@extends('layouts.app')

@section('title', 'Registrate')

@section('content')
    <div class='md:flex md:gap-10 md:justify-center md:items-center'>
        <div class='md:w-6/12 p-4'>
            <img src="{{ asset('img/registrar.webp') }}" alt="imagen registrar">
        </div>
        <div class='md:w-4/12 bg-white p-6 rounded-lg shadow-lg'>
            <form action='{{ route('signup.store') }}' method='POST' novalidate>
                @csrf
                <div class='mb-5'>
                    <label for='name' class='mb-2 block uppercase text-gray-500 font-bold'>Nombre</label>
                    <input
                        type="text"
                        id='name'
                        name='name'
                        placeholder='Tu nombre'
                        class='border p-3 mb-2 w-full rounded-lg @error('name') border-red-500 @enderror'
                        value="{{old('name')}}"
                    >
                    @error('name')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class='mb-5'>
                    <label for='username' class='mb-2 block uppercase text-gray-500 font-bold'>Nombre de usuario</label>
                    <input
                        type="text"
                        id='username'
                        name='username'
                        placeholder='Tu nombre de usuario'
                        class='border p-3 mb-2 w-full rounded-lg @error('username') border-red-500 @enderror'
                        value='{{old('username')}}'
                    >
                    @error('username')
                    <p class="bg-red-500 text-white rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
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
                    <label for='password_confirmation' class='mb-2 block uppercase text-gray-500 font-bold'>
                        Repite tu contraseña
                    </label>
                    <input
                        type="password"
                        id='password_confirmation'
                        name='password_confirmation'
                        placeholder='Tu contraseña'
                        class='border p-3 mb-2 w-full rounded-lg'
                    >
                </div>
                <button
                    type="submit"
                    class='bg-sky-600 hover:bg-sky-700 transitions-colors uppercase font-bold w-full p-3 text-white rounded-lg'
                >
                    Crear cuenta
                </button>
            </form>
        </div>
    </div>
@endsection
