<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $req)
    {
        $credentials = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials, $req->remember)) {
            return back()->withErrors(['credentials' => 'Información incorrecta'])->onlyInput('email');
        }

        return redirect()->route('post.index', auth()->user()->username);
    }
}
