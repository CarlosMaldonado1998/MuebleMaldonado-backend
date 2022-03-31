<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color; 

class ColorController extends Controller
{
    public function index(){
        return Color::all();
    }

    public function show(Color $color){
        return $color;
    }

    public function store (Request $request){
        $color = Color::create($request->all());

        return response()->json($color, 201);
    }

    public function update (Request $request, Color $color){
        $color ->update($request->all());
        
        return response()->json($color, 200);
    }

    public function delete (Color $color ){
        $color->delete();

        return response()->json(null, 204);
    }
}
