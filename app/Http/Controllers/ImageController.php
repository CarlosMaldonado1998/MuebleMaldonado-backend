<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\ImageCollection;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'url' =>'required',
        'url.*' =>'required|image|dimensions:min width=200, min height=200', 
        'product_id' =>'required|integer|exists:products,id'
    ];

    public function index(){
        return new ImageCollection(Image::paginate(10));
    }

    public function show(Image $image){
        return response()->json(new ImageResource($image), 200 );
    }

    public function store (Request $request){
        $this->authorize('create',Image::class);
        
        $request->validate(self::$rules , self::$messages);
        $images = $request->file('url');
        // Adaptarse a la carga de archivos únicos y múltiples
       if(is_array($images))
       {
           foreach($images as $key=>$v)
           {
                $path = $images[$key]->getRealPath();
                Cloudder::upload($path, null, array(
                     "folder" => "Mueble_Maldonado/products",
                    "overwrite" => FALSE,
                    "resource_type" => "image",
                    "responsive" => TRUE,
                ));
                $path = Cloudder::getResult();
                $link = Cloudder::getPublicId();
                 $image = Image::create(
                [
                    'url' => $link,
                    'product_id' => $request->product_id,
                ]
             );
           }
       } else {
           $path = $images->getRealPath();
            Cloudder::upload($path, null, array(
                     "folder" => "Mueble_Maldonado/products",
                    "overwrite" => FALSE,
                    "resource_type" => "image",
                    "responsive" => TRUE,
                ));
            $path = Cloudder::getResult();
            $link = Cloudder::getPublicId(); $image = Image::create(
               [
                   'url' => $link,
                   'product_id' => $request->product_id,
               ]
            );
       }      
    
        return response()->json("successs: Se han guardado las imagenes.", 201);
    }

   
    public function update (Request $request, Image $image){
        $this->authorize('update',$image);
        $request->validate([  
            'product_id' =>'required|integer|exists:products,id'
        ], self::$messages);
        
        $image->product_id = $request->product_id;
        if($request->hasFile('url')) {
            $publicId = $image->url;
            Cloudder::destroyImage($publicId);
            Cloudder::delete($publicId);
            $path = $request->url->getRealPath();
            Cloudder::upload($path, null, array(
                "folder" => "Mueble_Maldonado/colors",
                "overwrite" => FALSE,
                "resource_type" => "image",
                "responsive" => TRUE,
            ));
            $path = Cloudder::getResult();
            $image->url = Cloudder::getPublicId();
        }
        $image->update();
        return response()->json($image, 200);
    }

    public function delete (Image $image ){
        $this->authorize('delete',$image);
        $publicId = $image->url;
        Cloudder::destroyImage($publicId);
        Cloudder::delete($publicId);
        $image->delete();
        return response()->json(null, 204);
    }
}
