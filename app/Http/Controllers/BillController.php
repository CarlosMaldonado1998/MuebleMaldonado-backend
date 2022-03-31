<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill; 

class BillController extends Controller
{
    public function index(){
        return Bill::all();
    }

    public function show(Bill $bill){
        return $bill;
    }

    public function store (Request $request){
        $bill = Bill::create($request->all());

        return response()->json($bill, 201);
    }

    public function update (Request $request, Bill $bill){
        $bill ->update($request->all());
        
        return response()->json($bill, 200);
    }

    public function delete (Bill $bill ){
        $bill->delete();

        return response()->json(null, 204);
    }
}
