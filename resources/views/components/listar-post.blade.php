<div>
    {{-- @forelse($posts as $post) <p>{{$post->title}}</p> @empty <p>No hay post</p> @endforelse --}}
    @if($posts->count())
        <div class='grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6'>
            <!-- TODO: mostrar una imagen alternativa si no encuentra su imagen -->
            @foreach($posts as $post)
                <div>
                    <a href='{{ route('post.show', ['user' => $post->user, 'post' => $post]) }}'>
                        <img
                            src='{{asset('uploads') . '/' . $post->image}}'
                            alt='Imagen del post {{ $post->title }}'
                        >
                    </a>
                </div>
            @endforeach
        </div>

        <div>
            {{$posts->links()}}
        </div>

    @else
        <p>No hay posts aquí</p>
    @endif
</div>
