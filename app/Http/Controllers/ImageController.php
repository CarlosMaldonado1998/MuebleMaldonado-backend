<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index(){
        return Image::all();
    }

    public function show(Image $image){
        return $image;
    }

    public function store (Request $request){
        $image = Image::create($request->all());

        return response()->json($image, 201);
    }

    public function update (Request $request, Image $image){
        $image ->update($request->all());
        
        return response()->json($image, 200);
    }

    public function delete (Image $image ){
        $image->delete();

        return response()->json(null, 204);
    }
}
