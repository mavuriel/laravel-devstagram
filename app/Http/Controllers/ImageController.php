<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $req)
    {
        $image = $req->file('file');

        $imageName = Str::uuid() . '.' . $image->extension();

        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . "/$imageName";

        $imageServer->save($imagePath);

        return response()->json(['image' => $imageName]);
    }
}
