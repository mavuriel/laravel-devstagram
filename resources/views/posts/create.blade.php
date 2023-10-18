@extends('layouts.app')

@section('title', 'Crea un nuevo post')

@push('styles')
    {{--  Se puede agregar aqui el estilo por medio del CDN, se agregara al head del layout para esta vista  --}}
    {{--    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>--}}
@endpush

@section('content')
    <div class="md:flex md:items-center md:gap-10">
        <div class="w-full md:w-6/12 px-5">
            <form
                id="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"
                action="{{route('image.store')}}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
            </form>
        </div>
        <div class="w-full md:w-6/12 p-6 bg-white rounded-lg shadow-lg">
            <form method='POST' action='{{ route('post.store') }}' novalidate>
                @csrf
                <div class='mb-5'>
                    <label for='title' class='mb-2 block uppercase text-gray-500 font-bold'>Titulo</label>
                    <input
                        type='text'
                        id='title'
                        name='title'
                        placeholder='Titulo de la publicación'
                        class='border p-3 mb-2 w-full rounded-lg @error('title') border-red-500 @enderror'
                        value='{{old('title')}}'
                    >
                    @error('title')
                    <p class='bg-red-500 text-white rounded-lg text-sm p-2 text-center'>{{$message}}</p>
                    @enderror
                </div>
                <div class='mb-5'>
                    <label for='description' class='mb-2 block uppercase text-gray-500 font-bold'>Descripción</label>
                    <textarea
                        id='description'
                        name='description'
                        placeholder='Descripción de la publicación'
                        class='border p-3 mb-2 w-full rounded-lg @error('description') border-red-500 @enderror'
                    >{{old('description')}}</textarea>
                    @error('description')
                    <p class='bg-red-500 text-white rounded-lg text-sm p-2 text-center'>{{$message}}</p>
                    @enderror
                </div>
                <div class='mb-5'>
                    <input type="hidden" name="image" id='image-path' value='{{old('image')}}'>
                    @error('image')
                    <p class='bg-red-500 text-white rounded-lg text-sm p-2 text-center'>{{$message}}</p>
                    @enderror
                </div>
                <button
                    type="submit"
                    class='bg-sky-600 hover:bg-sky-700 transitions-colors uppercase font-bold w-full p-3 text-white rounded-lg'
                >
                    Crear publicación
                </button>
            </form>
        </div>
    </div>
@endsection
