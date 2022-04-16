<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'name' =>'required|string|unique:categories|max:255',
        'room_id' =>'required|integer|exists:rooms,id'
    ];

    public function index(){
        return new CategoryCollection(Category::all());
    }

    public function show(Category $category){
        return response()->json(new CategoryResource($category), 200);
    }

    public function store (Request $request){        
        $this->authorize('create',Category::class);
        $request->validate(self::$rules, self::$messages);
        $category = Category::create($request->all());
        return response()->json(new CategoryResource($category), 201);
    }

    public function update (Request $request, Category $category){
        $this->authorize('update',$category);
        $request->validate([
            'name' =>'required|string|unique:categories,name,'.$category->id.'|max:255', 
            'room_id' =>'required|integer|exists:rooms,id'
        ],self::$messages); 
        $category ->update($request->all());
        return response()->json($category, 200);
    }

    public function delete (Category $category ){
        $this->authorize('delete',$category);
        $category->delete();
        return response()->json(null, 204);
    }
}
