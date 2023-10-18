@extends('layouts.app')

@section('title', 'Editar perfil: ' . auth()->user()->username)

@section('content')
    <div class='md:flex md:justify-center'>
        <div class='md:w-1/2 bg-white shadow p-6'>
            <form action='{{route('profile.store')}}' method='POST' enctype='multipart/form-data' class='mt-10 md:mt-0'>
                @csrf
                <div class='mb-5'>
                    <label for='username' class='mb-2 uppercase block text-gray-500 font-bold'>
                        Nombre de usuario
                    </label>
                    <input
                        type='text'
                        name='username'
                        id='username'
                        class='border p-3 w-full rounded-lg @error('username') bg-red-500 @enderror'
                        value='{{auth()->user()->username}}'
                        placeholder='Tu nombre de usuario'
                    >
                    @error('username')
                    <p class='bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center'>{{$message}}</p>
                    @enderror
                </div>
                <div class='mb-5'>
                    <label for='image' class='mb-2 uppercase block text-gray-500 font-bold'>
                        Imagen de perfil
                    </label>
                    <input
                        type='file'
                        name='image'
                        id='image'
                        class='border p-3 w-full rounded-lg'
                        accept='.jpg, .jpeg, .png'
                    >
                </div>
                <button
                    type="submit"
                    class='bg-sky-600 hover:bg-sky-700 transitions-colors uppercase font-bold w-full p-3 text-white rounded-lg'
                >
                    Guardar cambios
                </button>
            </form>
        </div>
    </div>
@endsection
