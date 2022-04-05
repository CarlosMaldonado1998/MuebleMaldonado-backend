<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color; 
use App\Http\Resources\Color as ColorResource;
use App\Http\Resources\ColorCollection;
use Illuminate\Support\Facades\Storage;

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
        return new ColorColection(Color::paginate(10));
    }

    public function show(Color $color){
        return response()->json(new ColorResource($color), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Color::class);
        $request->validate(self::$rules, self::$messages);

        $color = Color::create($request->all());
        $path = $request->url->store('public/colors');
        $color->url = $path;
        $color->name = $request->name;
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
            Storage::delete($color->url);
            $path = $request->url->store('public/delivered');
            $color->url = $path;
        }
        $color->update();
        return response()->json($color, 200);
    }

    public function delete (Color $color ){
        $this->authorize('delete',$color);
        Storage::delete($color->url);
        $color->delete();
        return response()->json(null, 204);
    }
}
