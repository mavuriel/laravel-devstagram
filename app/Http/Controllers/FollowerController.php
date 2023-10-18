<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $req)
    {
        $user->followers()->attach(auth()->user()->id);

        return back();
    }

    public function destroy(User $user, Request $req)
    {
        $user->followers()->detach(auth()->user()->id);

        return back();
    }

    // TODO: hacer el unfollow antes del video
}
