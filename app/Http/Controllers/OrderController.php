<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;


class OrderController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'dimension' =>'required|string', 
        'value' => 'required|numeric',  
        'amount' => 'required|numeric', 
        'user_id' => 'required|integer|exists:users,id',
        'product_id' =>'required|integer|exists:products,id',
        'bill_id' =>'required|integer|exists:bills,id'
    ];
    
    public function index(){
        $this->authorize('viewAny', Order::class);
        return new OrderCollection(Order::paginate(10));
    }

    public function show(Order $order){
        $this->authorize('view', $order);
        return response()->json(new OrderResource($order), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Order::class);
        $request->validate(self::$rules, self::$messages);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function update (Request $request, Order $order){
        $this->authorize('update', $order);
        $request->validate(self::$rules, self::$messages);
        
        $order ->update($request->all());
        return response()->json($order, 200);
    }

    public function delete (Order $order ){
        $this->authorize('delete',$order);
        $order->delete();
        return response()->json(null, 204);
    }
}
