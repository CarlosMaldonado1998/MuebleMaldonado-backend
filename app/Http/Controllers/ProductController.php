<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Category;
use App\Models\Room;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'name' =>'required|string|max:255', 
        'code' => 'required|string|unique:products,code',  
        'description' => 'required|string', 
        'warranty' => 'required|string|max:255',
        'material' => 'required|string|max:255',
        'delivery_time' => 'required|string|max:255',
        'room_id' =>'required|integer|exists:rooms,id',
        'category_id' =>'required|integer|exists:categories,id',
        'images' => 'required',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
    ];

    public function index(){
        return new ProductCollection(Product::paginate(10));
    }

    public function all(){
        return new ProductCollection(Product::all());
    }

    public function show(Product $product){
        return response()->json(new ProductResource($product), 200);;
    }

    public function showProductsByCategory(Category $category){
        $product = Product::where("category_id", $category['id'])->get();
        return response()->json(new ProductCollection($product), 200);
    }

    public function showProductsByRoom(Room $room){
        $product = Product::where("room_id", $room['id'])->get();
        return response()->json(new ProductCollection($product), 200);
    }

    public function showProductsLatestAdd(){
        $product = Product::latest()->take(5)->get();
        return response()->json(new ProductCollection($product), 200);
    }

    public function store (Request $request){
        
        $this->authorize('create',Product::class);
    
        $request->validate(self::$rules , self::$messages);
        
        $product = Product::create($request->only('name','code','description', 'warranty', 'material', 'delivery_time', 'room_id', 'category_id'));
            
        if($request->has('prices')){
            foreach ($request->prices as $price) {
                $product->prices()->create($price);
            }
        }
            
        if($request->has('colors')){
            foreach ($request->colors as $color) {
                $product->colors()->attach($color);
            }
        }
            
            
        $images = $request->file('images');
			
        // Adaptarse a la carga de archivos únicos y múltiples
        if(is_array($images))
        {
            foreach($images as $key=>$v)
            {
                $path = $images[$key]->store('public/products');
                $product->images()->create(
                    [
                        'url' => $path,
                        'product_id' => $product->id,
                    ]
                    );
            
            }
        } else {
            $path = $images->store('public/products');
            $image = Image::create(
                [
                    'url' => $path,
                    'product_id' => $product->id,
                ]
                );
        }      

        return response()->json(new ProductResource($product), 201);
    }

    public function update (Request $request, Product $product){
        $this->authorize('update',Product::class);
        $request->validate([
            'name' =>'required|string|max:255', 
            'code' => 'required|string|unique:products,code,'.$product->id,  
            'description' => 'required|string', 
            'warranty' => 'required|string|max:255',
            'material' => 'required|string|max:255',
            'delivery_time' => 'required|string|max:255',
            'room_id' =>'required|integer|exists:rooms,id',
            'category_id' =>'required|integer|exists:categories,id'
        ], self::$messages);
        
        $product ->update($request->only('name','code','description', 'warranty', 'material', 'delivery_time', 'room_id', 'category_id'));
        
        return response()->json(new ProductResource($product), 200);
    }

    public function updateColors (Request $request, Product $product){
        $this->authorize('update',Product::class);
        $messages= [
            'required'=> 'El campo :attribute es obligatorio.',
        ];
        $request->validate([
            'colors' =>'required|array', 
        ],$messages);
        
        $product->colors()->detach();
        foreach ($request->colors as $color) {
            $product->colors()->attach($color);
        }
        return response()->json(new ProductResource($product), 200);
    }

    public function delete (Product $product ){
        $this->authorize('delete',Product::class);
        $product->delete();
        return response()->json(null, 204);
    }
}
