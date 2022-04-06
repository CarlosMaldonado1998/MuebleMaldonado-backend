<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill; 
use App\Http\Resources\Bill as BillResource;
use App\Http\Resources\BillCollection;

class BillController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'date' =>'required|date_format:Y-m-d H:i:s',
        'type_pay'  => 'required|string|max:255',
        'state'  => 'required|string|max:255',
        'iva' => 'required|numeric',
        'val_iva' => 'required|numeric',
        'subtotal' => 'required|numeric', 
        'total' => 'required|numeric', 
        'user_id' => 'required|integer|exists:users,id',
        'orders' => 'required'
    ];

    public function index(){
        $this->authorize('viewAny',Bill::class);
        return new BillCollection(Bill::paginate(10));
    }

    public function show(Bill $bill){
        $this->authorize('view',$bill);
        return response()->json(new BillResource($bill), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Bill::class);
        $request->validate(self::$rules, self::$messages);
        
        $bill = Bill::create($request->all());

        if($request->has('orders')){
            foreach ($request->orders as $order) {
                $bill->orders()->create($order);
            }
        }

        Mail::to(env('MAIL_CONTACT'))->send(new NewContact($bill));
        return response()->json(new BillResource($bill), 201);
    }

    public function update (Request $request, Bill $bill){
        $this->authorize('update', $bill);
        $request->validate([
            'date' =>'required|date_format:Y-m-d H:i:s',
            'type_pay'  => 'required|string|max:255',
            'state'  => 'required|string|max:255',
            'iva' => 'required|numeric',
            'val_iva' => 'required|numeric',
            'subtotal' => 'required|numeric', 
            'total' => 'required|numeric', 
            'user_id' => 'required|integer|exists:users,id',
        ], self::$messages);
        
        $bill ->update($request->all());
        return response()->json($bill, 200);
    }

    public function delete (Bill $bill ){
        $this->authorize('delete',$bill);
        $bill->delete();
        return response()->json(null, 204);
    }
}
