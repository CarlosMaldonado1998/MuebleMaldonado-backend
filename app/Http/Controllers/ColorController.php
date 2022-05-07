<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color; 
use App\Http\Resources\Color as ColorResource;
use App\Http\Resources\ColorCollection;
use Illuminate\Support\Facades\Storage;
use Cloudder;

class ColorController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'name' =>'required|string|max:255', 
        'url' => 'required|image|dimensions:min width=200, min height=200', 
    ];

    public function index(){
        return new ColorCollection(Color::all());
    }

    public function show(Color $color){
        return response()->json(new ColorResource($color), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Color::class);
        $request->validate(self::$rules, self::$messages);

        $color = Color::create($request->all());
        $color->name = $request->name;

        $path = $request->url->getRealPath();
        Cloudder::upload($path, null, array(
            "folder" => "Mueble_Maldonado/colors",
            "overwrite" => FALSE,
            "resource_type" => "image",
            "responsive" => TRUE,
        ));

        $path = Cloudder::getResult();
        $color->url = Cloudder::getPublicId();
        
        $color->save();
        return response()->json(new ColorResource($color), 201);
    }

    public function update (Request $request, Color $color){
        $this->authorize('update',$color);
        $request->validate([
            'name' =>'required|string', 
        ], self::$messages);
        $color->name = $request->name;
        if($request->hasFile('url')) {
            $publicId = $color->url;
            Cloudder::destroyImage($publicId);
            Cloudder::delete($publicId);
            $path = $request->url->getRealPath();
            Cloudder::upload($path, null, array(
                "folder" => "Mueble_Maldonado/colors",
                "overwrite" => FALSE,
                "resource_type" => "image",
                "responsive" => TRUE,
            ));
            $path = Cloudder::getResult();
            $color->url = Cloudder::getPublicId();
        }
        $color->update();
        return response()->json($color, 200);
    }

    public function delete (Color $color ){
        $this->authorize('delete',$color);
        $publicId = $color->url;
        Cloudder::destroyImage($publicId);
        Cloudder::delete($publicId);
        $color->delete();
        return response()->json(null, 204);
    }
}
