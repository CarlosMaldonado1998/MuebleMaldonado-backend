<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;
use App\Http\Resources\Price as PriceResource;
use App\Http\Resources\PriceCollection;

class PriceController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'dimension' =>'required|string', 
        'value' => 'required|numeric', 
        'product_id' =>'required|integer|exists:products,id', 
    ];

    public function index(){
        return new PriceCollection(Price::pagination(10));
    }

    public function show(Price $price){
        return response()->json(new PriceResource($price), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Price::class);
        $request->validate(self::$rules, self::$messages);

        $price = Price::create($request->all());
        return response()->json($price, 201);
    }

    public function update (Request $request, Price $price){
        $this->authorize('update', $price);
        $request->validate(self::$rules, self::$messages);
    
        $price ->update($request->all());
        return response()->json($price, 200);
    }

    public function delete (Price $price ){
        $this->authorize('delete',$price);
        $price->delete();
        return response()->json(null, 204);
    }
}
