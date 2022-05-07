<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Category;
use App\Http\Resources\Delivery as DeliveryResource;
use App\Http\Resources\DeliveryCollection;
use Illuminate\Support\Facades\Storage;
use Cloudder;

class DeliveryController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'title' =>'required|string', 
        'description' => 'required|string',  
        'url' => 'required|image|dimensions:min width=200, min height=200', 
        'category_id' =>'required|integer|exists:categories,id'
    ];

    public function index(){
        return new DeliveryCollection(Delivery::paginate(10));
    }

    public function all(){
        return new DeliveryCollection(Delivery::all());
    }

    public function show(Delivery $delivery){
        return response()->json(new DeliveryResource($delivery), 200);
    }

    public function showProductsDeliveredByCategory(Category $category){
        $product = Delivery::where("category_id", $category['id'])->get();
        return response()->json(new DeliveryCollection($product), 200);
    }

    public function store (Request $request){
        
        $this->authorize('create',Delivery::class);
        $request->validate( self::$rules, self::$messages);

        $delivery = Delivery::create($request->all());
        
        $path = $request->url->getRealPath();
        Cloudder::upload($path, null, array(
            "folder"=>"Mueble_Maldonado/delivered",
            "overwrite"=> FALSE,
            "resource_typ"=>"image",
            "responsive"=>TRUE
        ));
        $path = Cloudder::getResult();
        $delivery->url = Cloudder::getPublicId();
        $delivery->save();
        return response()->json($delivery, 201);
    }

    public function update (Request $request, Delivery $delivery){
        
        $this->authorize('update',$delivery);
        $request->validate([
            'title' =>'required|string', 
            'description' => 'required|string',  
            'category_id' =>'required|integer|exists:categories,id'
        ], self::$messages);

        $delivery->title = $request->title;
        $delivery->description = $request->description;
        $delivery->category_id = $request->category_id;
        if($request->hasFile('url')) {
            $publicId = $color->url;
            Cloudder::destroyImage($publicId);
            Cloudder::delete($publicId);
            $delivery =$request->url->getRealPath();
            Cloudder::upload($path, null, array(
                "folder"=>"Mueble_Maldonado/delivered",
                "overwrite"=>FALSE,
                "resource_typ"=>"image",
                "responsive"=>TRUE
            ));
            $path = Cloudder::getResult();
            $delivery->url = Cloudder::getPublicId();
        }
        $delivery->update();
        return response()->json($delivery, 200);
    }

    public function delete (Delivery $delivery ){
        $this->authorize('delete',$delivery);
        $publicId = $delivery->url;
        Cloudder::destroyImage($publicId);
        Cloudder::delete($publicId);
        $delivery->delete();
        return response()->json(null, 204);
    }
}
