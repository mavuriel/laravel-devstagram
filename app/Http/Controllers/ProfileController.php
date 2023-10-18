<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile.index');
    }

    public function store(Request $req)
    {
        $req->request->add(['username' => Str::slug($req->username)]);

        $validData = $req->validate([
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);


        if ($req->image) {
            $image = $req->file('image');

            $imageName = Str::uuid() . '.' . $image->extension();

            $imageServer = Image::make($image);
            $imageServer->fit(1000, 1000);

            $imagePath = public_path('profiles') . "/$imageName";

            $imageServer->save($imagePath);
        }

        // TODO: cambio de contraseña
        // TODO: cambio de email

        $user = User::find(auth()->user()->id);
        $user->username = $validData['username'];
        $user->profile_image = $imageName ?? auth()->user()->profile_image ?? '';
        $user->save();

        return redirect()->route('post.index', $user->username);
    }
}
