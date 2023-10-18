@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class='grid grid-cols-2 gap-10'>
        <section>
            <div>
                <img src='{{ asset('uploads').'/'.$post->image }}' alt='Imagen de {{$post->title}}'>
            </div>

            <div class='p-3 flex gap-2'>
                @auth()
                    <livewire:like-post :post="$post"/>
                @endauth
            </div>
            <p class='font-bold'>{{$post->user->username}}</p>
            <p class='text-sm text-gray-500'>{{$post->created_at->diffForHumans()}}</p>
            <p class='mt-5'>{{$post->description}}</p>

            @auth()
                @if($post->user_id === auth()->user()->id)
                    <div class='mt-2'>
                        <form method='POST' action='{{route('post.destroy', $post)}}'>
                            @method('DELETE')
                            @csrf
                            <button
                                type='submit'
                                class='bg-red-500 hover:bg-red-600 rounded cursor-pointer py-2 px-4 font-bold text-white'
                            >
                                Eliminar publicación
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </section>
        <section class='p-5'>
            <div class='shadow bg-white p-5 mb-5'>
                <p class='text-xl font-bold text-center mb-4'>Comentarios</p>

                @if(session('message'))
                    <div class='mb-2 py-3 px-2 border rounded-md bg-green-600 text-white text-center font-bold uppercase'>
                        <p>{{session('message')}}</p>
                    </div>
                @endif

                @auth()
                    <form action='{{route('comment.store', compact('user', 'post'))}}' method='POST'>
                        @csrf
                        <div class='mb-5'>
                            <label
                                for='comment'
                                class='mb-2 block uppercase text-gray-500 font-bold'
                            >
                                Nuevo comentario
                            </label>
                            <textarea
                                id='comment'
                                name='comment'
                                placeholder='Agrega tu comentario'
                                class='border p-3 mb-2 w-full rounded-lg @error('comment') border-red-500 @enderror'
                            >{{old('comment')}}</textarea>
                            @error('comment')
                            <p class='bg-red-500 text-white rounded-lg text-sm p-2 text-center'>{{$message}}</p>
                            @enderror
                        </div>
                        <button
                            type="submit"
                            class='bg-sky-600 hover:bg-sky-700 transitions-colors uppercase font-bold w-full p-3 text-white rounded-lg'
                        >
                            Comenta
                        </button>
                    </form>
                @endauth
            </div>

            <div class='shadow bg-white p-5 my-5 max-h-96 overflow-y-scroll'>
                @if($post->comments->count())
                    @foreach($post->comments as $comment)
                        <div class='p-5 border-gray-300 border-b'>
                            <a
                                href='{{route('post.index', ['user' => $comment->user])}}'
                                class='font-bold'
                            >{{$comment->user->username}}</a>
                            <p>{{$comment->comment}}</p>
                            <p class='text-sm text-gray-500'>{{$comment->created_at->diffForHumans()}}</p>
                        </div>
                    @endforeach
                @else
                    <p>No hay comentarios aun</p>
                @endif
            </div>
        </section>
    </div>
@endsection
