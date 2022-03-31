<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index(){
        return Delivery::all();
    }

    public function show(Delivery $delivery){
        return $delivery;
    }

    public function store (Request $request){
        $delivery = Delivery::create($request->all());

        return response()->json($delivery, 201);
    }

    public function update (Request $request, Delivery $delivery){
        $delivery ->update($request->all());
        
        return response()->json($delivery, 200);
    }

    public function delete (Delivery $delivery ){
        $delivery->delete();

        return response()->json(null, 204);
    }
}
