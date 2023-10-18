<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $req)
    {

        $req->request->add(['username' => Str::slug($req->username)]);

        $req->validate([
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $req->name,
            'username' => $req->username,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        // Autenticar usuario

        // Método uno

        // auth()->attempt([
        //     'email' => $req->email,
        //     'password' => $req->password,
        // ]);

        // Método dos

        auth()->attempt($req->only('email', 'password'));

        return redirect()->route('post.index', auth()->user()->username);
    }
}
