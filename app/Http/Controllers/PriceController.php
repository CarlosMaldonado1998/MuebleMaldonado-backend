<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceController extends Controller
{
    public function index(){
        return Price::all();
    }

    public function show(Price $price){
        return $price;
    }

    public function store (Request $request){
        $price = Price::create($request->all());

        return response()->json($price, 201);
    }

    public function update (Request $request, Price $price){
        $price ->update($request->all());
        
        return response()->json($price, 200);
    }

    public function delete (Price $price ){
        $price->delete();

        return response()->json(null, 204);
    }
}
