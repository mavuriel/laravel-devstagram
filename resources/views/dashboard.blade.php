@extends('layouts.app')

@section('title', "@$user->username")

@section('content')
    <div class='flex justify-center'>
        <div class='w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row md:justify-center md:items-start'>
            <div class='w-3/12 md:w-6/12 px-5'>
                <img
                    src='{{ $user->profile_image ? asset('profiles') . '/' . $user->profile_image : asset('img/usuario.svg') }}'
                    alt='user image'
                >
            </div>
            <div class='md:w-8/12 lg:w-6/12 px-5 mt-2'>
                <div class='flex items-center gap-4'>
                    <p class="text-gray-700 text-2xl">{{$user->username}}</p>
                    @auth()
                        @if($user->id === auth()->user()->id)
                            <a
                                href='{{route('profile.index')}}'
                                class='text-gray-600 hover:text-gray-500 cursor-pointer'
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-edit"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    stroke-width="2"
                                    stroke="currentColor"
                                    fill="none"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <div class="mt-5 flex flex-col gap-1 md:flex-row md:gap-3">
                    <p class="text-gray-800 text-sm font-bold">
                        {{$user->followers->count()}}
                        <small>@choice('Seguidor|Seguidores', $user->followers->count())</small>
                    </p>
                    <p class="text-gray-800 text-sm font-bold">
                        {{$user->following->count()}}
                        <small>Siguiendo</small>
                    </p>
                    <p class="text-gray-800 text-sm font-bold">{{$user->posts->count()}} <small>Post</small></p>
                </div>

                @auth()
                    @if($user->id !== auth()->user()->id)
                        @if(!$user->isFollowBy(auth()->user()))
                            <form method='POST' action='{{route('follower.store', $user)}}'>
                                @csrf
                                <button
                                    type="submit"
                                    class='bg-blue-600 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer'
                                >
                                    Seguir
                                </button>
                            </form>
                        @else
                            <form method='POST' action='{{route('follower.destroy', $user)}}'>
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class='bg-red-600 text-white uppercase rounded-lg px-3 py-1 text-sm font-bold cursor-pointer'
                                >
                                    Dejar de seguir
                                </button>
                            </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class='container mx-auto mt-10'>
        <h2 class='text-4xl text-center font-black my-10'>Publicaciones</h2>
        <x-listar-post :posts='$posts'/>
    </section>
@endsection
