<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(20);

        return view('dashboard', compact('user', 'posts'));
    }

    public function store(Request $req)
    {
        $postData = $req->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);


        // Post::create(array_merge($postData, ['user_id' => auth()->user()->id]));

        // Post::create([
        //     'title' => $req->title,
        //     'description' => $req->description,
        //     'image' => $req->image,
        //     'user_id' => auth()->user()->id,
        // ]);

        // $post = new Post();
        // $post->title = $postData['title'];
        // $post->description = $postData['description'];
        // $post->image = $postData['image'];
        // $post->user_id = auth()->user()->id;
        // $post->save();

        $req->user()->posts()->create([
            'title' => $req->title,
            'description' => $req->description,
            'image' => $req->image,
            'user_id' => auth()->user()->id,
        ]);


        return redirect()->route('post.index', auth()->user()->username);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', compact('post', 'user'));
    }

    public function destroy(Post $post)
    {
        // Uso de policy para realizar el delete
        $this->authorize('delete', $post);

        $post->delete();

        // Eliminar imagen
        $imagePath = public_path('uploads/' . $post->image);

        if (File::exists($imagePath)) {
            unlink($imagePath);
        }

        // TODO: no se recargan los post cuando se elimina en la vista de otro usuario

        return redirect()->route('post.index', auth()->user()->username);
    }
}
