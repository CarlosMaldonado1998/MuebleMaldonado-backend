<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Resources\Room as RoomResource;
use App\Http\Resources\RoomCollection;

class RoomController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'name' =>'required|string|unique:rooms|max:255', 
        'url' => 'required|image|dimensions:min width=200, min height=200', 
    ];

    public function index(){
        return new RoomCollection(Room::all());
    }

    public function show(Room $room){
        return response()->json(new RoomResource($room), 200);
    }

    public function store (Request $request){
        $this->authorize('create',Room::class);
        $request->validate( self::$rules, self::$messages);
        $room = Room::create($request->all());
         $path = $request->url->store('public/rooms');
        $color->url = $path;
        $color->name = $request->name;
        $color->save();
        return response()->json($room, 201);
    }

    public function update (Request $request, Room $room){
        $this->authorize('update',$room);
        $request->validate([
            'name' =>'required|string|unique:rooms,name,'.$room->id.'|max:255', 
        ],self::$messages);

        $room->name = $request->name;
        if($request->hasFile('url')) {
            Storage::delete($room->url);
            $path = $request->url->store('public/rooms');
            $room->url = $path;
        }
        $room->update();
        return response()->json($room, 200);
    }

    public function delete (Room $room ){ 
        $this->authorize('delete',$room);
        $room->delete();
        return response()->json(null, 204);
    }
}
