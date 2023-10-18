<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $req, User $user, Post $post)
    {
        $data = $req->validate([
            'comment' => 'required|max:255',
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comment' => $data['comment'],
        ]);

        return back()->with('message', 'Comentario creado');
    }
}
